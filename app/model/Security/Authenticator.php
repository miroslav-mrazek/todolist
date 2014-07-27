<?php

namespace Todolist;

use Nette\Security\IAuthenticator,
	Nette\Security\Identity,
	Nette\Security\AuthenticationException,
	Nette\Utils\Strings,
	Nette\Security\Passwords;


/**
 * Třída zajišťující ověření uživatele.
 */
class Authenticator implements IAuthenticator
{

	/** @var UserRepository */
	private $users;


	public function __construct(UserRepository $users)
	{
		$this->users = $users;
	}


	/**
	 * Ověří uživatele.
	 * 
	 * @param array přihlašovací údaje
	 * @return Identity
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($email, $password) = $credentials;
		$user = $this->users->getByEmail($email);

		if (is_null($user))
		{
			throw new AuthenticationException('Neznámý uživatel.', self::IDENTITY_NOT_FOUND);
		}
		elseif (!Passwords::verify($password, $user->password))
		{
			throw new AuthenticationException('Špatné heslo.', self::INVALID_CREDENTIAL);
		}
		//barDump(Passwords::hash($password)); # Jen pro potřeby ručni změny hesla
		
		return new Identity($user->id, 'user', array('name' => $user->name));
	}


	/**
	 * Vytvoří hash hesla.
	 * 
	 * @param string heslo
	 * @param string salt
	 * @return string
	 */
	public static function calculateHash($password, $salt = NULL)
	{
		if ($password === Strings::upper($password)) { // perhaps caps lock is on
			$password = Strings::lower($password);
		}
		return crypt($password, $salt ? : '$2a$07$' . Strings::random(22));
	}

}

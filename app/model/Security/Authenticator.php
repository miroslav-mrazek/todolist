<?php

namespace Todolist;

use Nette\Security\IAuthenticator,
	Nette\Security\Identity,
	Nette\Security\AuthenticationException,
	Nette\Utils\Strings;


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
		list($username, $password) = $credentials;
		$user = $this->users->getByUsername($username);

		if (is_null($user)) {
			throw new AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
		}

//		if ($user->password !== $this->calculateHash($password, $user->password))
//		{
//			throw new AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
//		}

		return new Identity($user->id, $user->role, array('name' => $user->name));
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

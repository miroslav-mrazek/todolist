<?php

namespace Todolist;

use Nette\Security\IAuthenticator,
	Nette\Security\Identity,
	Nette\Security\AuthenticationException,
	Nette\Security\Passwords;


/**
 * Třída zajišťující ověření uživatele.
 */
class Authenticator implements IAuthenticator
{

	/** @var UserRepository */
	private $userRepository;


	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
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
		$user = $this->userRepository->getByEmail($email);

		if (is_null($user))
		{
			throw new AuthenticationException('Neznámý uživatel.', self::IDENTITY_NOT_FOUND);
		}
		elseif (!Passwords::verify($password, $user->password))
		{
			throw new AuthenticationException('Špatné heslo.', self::INVALID_CREDENTIAL);
		}
		//barDump(Passwords::hash($password)); # Jen pro potřeby ruční změny hesla
		
		return new Identity($user->id, ['user'], ['name' => $user->name]);
	}

}

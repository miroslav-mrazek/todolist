<?php

namespace Todolist;


trait TInjectUserRepository
{

	/**
	 * @var UserRepository
	 */
	protected $userRepository;
	
	
	public function injectUserRepository(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

}

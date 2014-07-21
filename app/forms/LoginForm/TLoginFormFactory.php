<?php

namespace Todolist;


trait TLoginFormFactory
{

	/**
	 * @var LoginFormFactory
	 */
	protected $loginFormFactory;
	
	
	public function injectLoginFormFactory(LoginFormFactory $loginFormFactory)
	{
		$this->loginFormFactory = $loginFormFactory;
	}

}

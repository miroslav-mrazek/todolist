<?php

namespace Todolist;


trait TInjectLoginFormFactory
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

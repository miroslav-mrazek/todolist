<?php

namespace Todolist;


interface ILoginFormFactory
{

	/**
	 * @return LoginForm
	 */
	function create();

}

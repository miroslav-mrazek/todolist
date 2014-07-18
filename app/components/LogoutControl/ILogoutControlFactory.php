<?php

namespace Todolist;


interface ILogoutControlFactory
{

	/**
	 * @return LogoutControl
	 */
	function create();

}

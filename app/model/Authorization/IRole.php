<?php

namespace Todolist;

use Nette\Security\IRole as INetteRole;


/**
 * Rozhraní popisující držitele role
 */
interface IRole extends INetteRole
{

	/**
	 * Vrátí ID držitele role.
	 * 
	 * @return int
	 */
	function getId();

}
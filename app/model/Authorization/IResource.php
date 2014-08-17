<?php

namespace Todolist;

use Nette\Security\IResource as INetteResource;


/**
 * Rozhraní popisující datový zdroj
 */
interface IResource extends INetteResource
{

	/**
	 * Vrátí ID vlastníka zdroje, nebo NULL (Nette\Security\IAuthorizator::ALL)
	 * 
	 * @return int|NULL
	 */
	function getOwnerId();

}
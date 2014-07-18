<?php

namespace Todolist;

use Nette\Security\IAuthorizator;


/**
 * Třída ověřující oprávnění.
 */
class Authorizator implements IAuthorizator
{

	public function isAllowed($role, $resource, $privilege)
	{
		if($role == 'admin')
		{
			return TRUE;
		}
		elseif($role == 'user')
		{
			return FALSE;
		}
		else
		{
			return FALSE;
		}
	}

}

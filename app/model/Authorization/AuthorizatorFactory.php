<?php

namespace Todolist;

use Nette\Security\IAuthorizator,
	Nette\Security\Permission,
	Nette\Security\IResource;


class AuthorizatorFactory
{

	/**
	 * @return IAuthorizator
	 */
	public function create()
	{
		$authorizator = new Permission;
		
		
		/* seznam uživatelských rolí */
		$authorizator->addRole('guest');
		$authorizator->addRole('user');
		$authorizator->addRole('admin');
		
		
		/* seznam zdrojů */
		$authorizator->addResource('entity');
		$authorizator->addResource('User', 'entity');
		$authorizator->addResource('Project', 'entity');
		$authorizator->addResource('Task', 'entity');
		$authorizator->addResource('Thing', 'entity');
		
		
		/* seznam pravidel oprávnění */
		$authorizator->allow('user', 'entity',	IAuthorizator::ALL, [$this, 'isOwner']);
		$authorizator->allow('admin', 'entity', IAuthorizator::ALL);
		
		
		return $authorizator;
	}


	/**
	 * Zjistí, zda je držitel role vlatníkem zdroje
	 * 
	 * @return bool
	 */
	public function isOwner(Permission $permission)
	{
		if ($permission->queriedResource instanceof IResource)
		{
			return	$permission->queriedResource->getOwnerId() === IAuthorizator::ALL ||	# neomezený vlastník
					$permission->queriedRole->getId() === $permission->queriedResource->getOwnerId();
		}
		else
		{
			return TRUE; # statický není omezen podle vlastníka
		}
	}

}

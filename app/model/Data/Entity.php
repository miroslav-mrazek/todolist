<?php

namespace Todolist;

use LeanModel\Entity as LeanEntity;


/**
 * Entita která je zároveň zdrojem podle autorizátoru
 */
abstract class Entity extends LeanEntity implements IResource
{
	
	/*
	 * Implementace rozhraní IResource
	 */
	public function getResourceId()
	{
		return $this->getReflection()->getShortName();
	}
	
	/*
	 * Implementace rozhraní IResource
	 */
	abstract public function getOwnerId();
	
}

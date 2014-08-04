<?php

namespace Todolist;

use LeanMapper\IEntityFactory;


class EntityFactory implements IEntityFactory
{

	public function createEntity($entityClass, $arg = null)
	{
		return new $entityClass($arg);
	}


	public function createCollection(array $entities)
	{
		return Collection::from($entities);
	}

}
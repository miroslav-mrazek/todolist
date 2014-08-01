<?php

namespace Todolist;

use LeanMapper\IEntityFactory;


class EntityFactory implements IEntityFactory
{

	/*
	 * @inheritdoc
	 */
	public function createEntity($entityClass, $arg = null)
	{
		return new $entityClass($arg);
	}

	/*
	 * @inheritdoc
	 */
	public function createCollection(array $entities)
	{
		return Collection::from($entities);
	}

}
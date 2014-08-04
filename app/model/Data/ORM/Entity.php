<?php

namespace Todolist;

use LeanMapper\Entity as LeanEntity;


abstract class Entity extends LeanEntity
{
	
/**
 * Umožňuje předat entitě místo navázaných entit jejich 'id'
 *
 * @param string $name
 * @param mixed  $value
 */
function __set($name, $value)
{
	$property = $this->getReflection()->getEntityProperty($name);
	if ($property->hasRelationship() && !($value instanceof Entity))
	{
		$relationship = $property->getRelationship();
		$this->row->{$property->getColumn()} = $value;
		$this->row->cleanReferencedRowsCache($relationship->getTargetTable(), $relationship->getColumnReferencingTargetTable());
	}
	else
	{
		parent::__set($name, $value);
	}
}

}

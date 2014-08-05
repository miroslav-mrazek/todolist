<?php

namespace Todolist;

use LeanMapper\Entity as LeanEntity,
	DateTime;


abstract class Entity extends LeanEntity
{
	
	/**
	 * Formát času, který se použije při převodu entity na pole.
	 * @var string
	 */
	protected $dateTimeFormat = DateTime::ATOM;
	
	
	/**
	 * Umožňuje předat entitě místo navázaných entit jejich 'id'
	 *
	 * @param string $name
	 * @param mixed  $value
	 */
	public function __set($name, $value)
	{
		$property = $this->getCurrentReflection()->getEntityProperty($name);
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


	public function toArray()
	{
		$array = [];
		foreach($this->getData() as $property => $value)
		{
			if($value instanceof LeanEntity) {
				$array[$property] = $value->id;
			}
			elseif($value instanceof Collection) {
				$array[$property] = $value->toArrayOfKeys();
			}
			elseif($value instanceof DateTime) {
				$array[$property] = $value->format($this->dateTimeFormat);
			}
			else {
				$array[$property] = $value;
			}
		}
		return $array;
	}

}

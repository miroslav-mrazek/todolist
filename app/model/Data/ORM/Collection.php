<?php

namespace Todolist;

use Nette\ArrayHash;


class Collection extends ArrayHash
{
	
	/**
	 * Převede kolekci na pole entit
	 * @return array
	 */
	public function toArray()
	{
		$array = [];
		foreach($this as $entity)
		{
			$array[] = $entity->toArray();
		}
		return $array;
	}
	
	
	/**
	 * Převede kolekci na pole identifikátorů
	 * @return array
	 */
	public function toArrayOfIdentifiers()
	{
		$array = [];
		foreach($this as $entity)
		{
			$array[] = $entity->toIdentifier();
		}
		return $array;
	}

}

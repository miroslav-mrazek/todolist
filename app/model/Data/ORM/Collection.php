<?php

namespace Todolist;

use Nette\ArrayHash;


class Collection extends ArrayHash
{
	
	public function toArray()
	{
		$array = [];
		foreach($this as $entity)
		{
			$array[$entity->id] = $entity->toArray();
		}
		return $array;
	}
	
	
	public function toArrayOfKeys()
	{
		$array = [];
		foreach($this as $entity)
		{
			$array[] = $entity->id;
		}
		return $array;
	}

}

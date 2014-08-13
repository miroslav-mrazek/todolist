<?php

namespace Todolist;

use LeanModel\IFilters,
	LeanMapper\Connection,
	LeanMapper\Fluent;


class TaskFilters implements IFilters
{
	
	public function registerFilters(Connection $connection)
	{
		$connection->registerFilter('undone', [$this, 'undone']);
	}
	
	
	public function undone(Fluent $statement)
	{
		$statement->where(['done' => FALSE]);
	}
	
}

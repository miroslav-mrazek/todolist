<?php

namespace Todolist;


class TaskRepository extends Repository
{
	
	
	/**
	 * Nastaví úkol jako splněný
	 * 
	 * @param int $id
	 */
	public function setDone($id)
	{
		$task = $this->get($id);
		$task->done = TRUE;
		$this->persist($task);
	}
	
	
	/**
	 * Nastaví úkol jako nesplněný
	 * 
	 * @param int $id
	 */
	public function setUndone($id)
	{
		$task = $this->get($id);
		$task->done = FALSE;
		$this->persist($task);
	}
	
}

<?php

namespace Todolist;


class TaskService
{

	/** @var TaskRepository */
	protected $tasks;


	public function __construct(TaskRepository $tasks)
	{
		$this->tasks = $tasks;
	}


	/**
	 * Metoda nastaví úkol jako (ne)splněný
	 * 
	 * @param int     $id
	 * @param boolean $done
	 */
	public function setDone($id, $done = TRUE)
	{
		$task = $this->tasks->get($id);
		$task->done = $done;
		$this->tasks->persist($task);
	}

}

<?php

namespace Todolist;


trait TInjectTaskRepository
{

	/**
	 * @var TaskRepository
	 */
	protected $taskRepository;
	
	
	public function injectTaskRepository(TaskRepository $taskRepository)
	{
		$this->taskRepository = $taskRepository;
	}

}

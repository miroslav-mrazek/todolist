<?php

namespace Todolist;


trait TTaskFormFactory
{

	/**
	 * @var TaskFormFactory
	 */
	protected $taskFormFactory;
	
	
	public function injectTaskFormFactory(TaskFormFactory $taskFormFactory)
	{
		$this->taskFormFactory = $taskFormFactory;
	}

}

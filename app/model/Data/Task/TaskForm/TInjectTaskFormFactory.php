<?php

namespace Todolist;


trait TInjectTaskFormFactory
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

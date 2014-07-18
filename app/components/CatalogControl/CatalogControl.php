<?php

namespace Todolist;

use Nette\InvalidArgumentException;


class CatalogControl extends BaseControl
{

	/** @var TaskService */
	protected $taskService;

	/** @var CatalogRepository */
	protected $catalogs;

	/** @var ITaskFormFactory */
	protected $taskFormFactory;


	
	public function __construct(TaskService $taskService,
								CatalogRepository $catalogs,
								ITaskFormFactory $taskFormFactory)
	{
		parent::__construct();
		$this->taskService = $taskService;
		$this->catalogs = $catalogs;
		$this->taskFormFactory = $taskFormFactory;
	}


	public function render($id)
	{
		$catalog = $this->catalogs->get($id);
		$this->template->catalog = $catalog;
		$this->template->tasks = $catalog->tasks;
		
		$this->template->setFile(__DIR__ . '/catalogControl.latte');
		$this->template->render();
	}


	/**
	 * Signál, který nastaví úkol jako (ne)splněný
	 * 
	 * @param int    $taskId
	 * @param string $done 'yes'|'no'
	 */
	public function handleSetDone($taskId, $done)
	{
		if ($done === "yes") {
			$done = TRUE;
		}
		elseif ($done === "no") {
			$done = FALSE;
		}
		else {
			throw new InvalidArgumentException("Parametr 'done' může nabývat jen hodnot 'yes', nebo 'no'.");
		}

		$this->taskService->setDone($taskId, $done);
		
		if ($this->presenter->isAjax()) {
			$this->invalidateControl('tasks');
		}
		else {
			$this->presenter->redirect('this');
		}
	}


	/**
	 * @return TaskForm
	 */
	public function createComponentNewTaskForm()
	{
		$newTaskForm = $this->taskFormFactory->create();
		return $newTaskForm;
	}

}

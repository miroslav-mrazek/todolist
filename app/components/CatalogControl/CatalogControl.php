<?php

namespace Todolist;

use Nette\InvalidArgumentException;


class CatalogControl extends BaseControl
{

	/** @var TaskService */
	protected $taskService;

	/** @var CatalogRepository */
	protected $catalogs;
	
	/** @var int */
	protected $id;

	
	public function __construct($id,
								TaskService $taskService,
								CatalogRepository $catalogs)
	{
		parent::__construct();
		$this->id = $id;
		$this->taskService = $taskService;
		$this->catalogs = $catalogs;
	}


	public function render()
	{
		$this->template->catalog = $this->catalogs->get($this->id);
		
		$this->prepareTemplate();
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
		
		$this->presenter->redirect('this');
	}

}

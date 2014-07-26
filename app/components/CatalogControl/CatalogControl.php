<?php

namespace Todolist;


class CatalogControl extends BaseControl
{

	/** @var TaskService */
	protected $taskRepository;

	/** @var Catalog */
	protected $catalog;
	

	public function __construct($id,
						CatalogRepository $catalogRepository,
						TaskRepository $taskRepository
					)
	{
		parent::__construct();
		
		$this->catalog = $catalogRepository->get($id);
		$this->taskRepository = $taskRepository;
	}


	public function render()
	{
		$this->template->catalog = $this->catalog;
		
		$this->loadTemplate();
		$this->template->render();
	}


	/**
	 * Signál, který nastaví úkol jako splněný
	 * 
	 * @param int $taskId
	 */
	public function handleSetDone($taskId)
	{
		$this->taskRepository->setDone($taskId);
		$this->redirect('this');
	}
	
	/**
	 * Signál, který nastaví úkol jako nesplněný
	 * 
	 * @param int $taskId
	 */
	public function handleSetUndone($taskId)
	{
		$this->taskRepository->setUndone($taskId);
		$this->redirect('this');
	}

}

<?php

namespace Todolist;


final class CatalogPresenter extends SecuredPresenter
{
	
	/**
	 * @var ICatalogControlFactory
	 * @inject
	 */
	public $catalogControlFactory;

	use TCatalogFormFactory;
	
	/** @var ITaskFormFactory
	 * @inject
	 */
	public $taskFormFactory;


	/**
	 * Pohled na seznam a jeho úkoly
	 * 
	 * @param string
	 */
	public function actionList($id = NULL)
	{
		if(!$this->user->isAllowed('catalog', 'read'))
		{
			$this->flashMessage("nemate prava");
			$this->template->catalogs = [];
			$this->template->catalogId = NULL;
		}
		else
		{
			$this->template->catalogs = $this->userEntity->catalogs;
			$this->template->catalogId = $id;
		}
	}


	/**
	 * @return CatalogControl
	 */
	public function createComponentCatalogControl()
	{
		return $this->catalogControlFactory->create();
	}


	/**
	 * @return CatalogForm
	 */
	public function createComponentCatalogForm()
	{
		return $this->catalogFormFactory->create();
	}
	
	/**
	 * @return TaskForm
	 */
	public function createComponentNewTaskForm()
	{
		return $this->taskFormFactory->create();
	}

}

<?php

namespace Todolist;


final class CatalogPresenter extends SecuredPresenter
{
	
	/**
	 * @var ICatalogControlFactory
	 * @inject
	 */
	public $catalogControlFactory;

	use TInjectCatalogFormFactory;
	
	use TInjectTaskFormFactory;
	
	/**
	 * @var int
	 * @persistent
	 */
	public $id;


	/**
	 * @param int|NULL
	 */
	public function actionList($id = NULL)
	{
	}
	
	public function renderList()
	{
		$this->template->catalogs = $this->userEntity->catalogs;
		$this->template->catalogId = $this->id;
		
		if($this->isAjax()) {
			$this->redrawControl('content');
		}
	}


	/**
	 * @return CatalogControl
	 */
	public function createComponentCatalogControl()
	{
		return $this->catalogControlFactory->create($this->id);
	}


	/**
	 * @return CatalogForm
	 */
	public function createComponentCatalogForm()
	{
		$form = $this->catalogFormFactory->create($this->user->id);
		$form->onSuccess[] = function() {
			if($this->isAjax())	{
				$this->redrawControl('projectList');
			}
			else {
				$this->redirect('this');
			}
		};
		return $form;
	}
	
	/**
	 * @return TaskForm
	 */
	public function createComponentTaskForm()
	{
		$form = $this->taskFormFactory->create($this->id);
		$form->onSuccess[] = function() {
			if($this->isAjax())	{
				$this->presenter->redrawControl('taskList');
			}
			else {
				$this->redirect('this');
			}
		};
		return $form;
	}

}

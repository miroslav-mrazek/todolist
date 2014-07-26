<?php

namespace Todolist;


final class CatalogPresenter extends SecuredPresenter
{
	
	use TInjectCatalogControlFactory;
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
			$this->redirect('this');
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
			$this->redirect('this');
		};
		return $form;
	}

}

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
	
	use TTaskFormFactory;
	
	/**
	 * @var int
	 * @persistent
	 */
	public $id;


	/**
	 * @param int
	 */
	public function actionList($id = NULL)
	{
		$this->template->catalogs = $this->userEntity->catalogs;
		$this->template->catalogId = $id;
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

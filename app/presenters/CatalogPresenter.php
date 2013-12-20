<?php

/**
 * TODOLIST
 * Školní projekt k seznámení s Nette a ORM
 * 
 * @author MMR <miroslav.mrazek@gmail.com>
 */

namespace Todolist;

use Todolist\Components\CatalogControl,
	Todolist\Components\ICatalogControlFactory,
	Todolist\Components\CatalogForm,
	Todolist\Components\ICatalogFormFactory;


/**
 * Catalog presenter.
 */
final class CatalogPresenter extends SecuredPresenter
{
	
	/**
	 * @var \Todolist\Components\ICatalogControlFactory
	 * @inject
	 */
	public $catalogControlFactory;
	
	/**
	 * @var \Todolist\Components\ICatalogFormFactory
	 * @inject
	 */
	public $catalogFormFactory;


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
	 * Vytvoří komponentu catalogControl
	 * 
	 * @return CatalogControl
	 */
	public function createComponentCatalogControl()
	{
		return $this->catalogControlFactory->create();
	}


	/**
	 * Vytvoří komponentu newCatalogForm
	 * 
	 * @return CatalogForm
	 */
	public function createComponentNewCatalogForm()
	{
		return $this->catalogFormFactory->create();
	}

}

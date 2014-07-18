<?php

namespace Todolist;

use Nette\Application\UI\Form;


class CatalogForm extends BaseControl
{

	/** @var CatalogRepository */
	protected $catalogs;


	public function __construct(CatalogRepository $catalogs)
	{
		parent::__construct();
		$this->catalogs = $catalogs;
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/catalogForm.latte');
		$this->template->render();
	}
	
	
	/**
	 * @return Form
	 */
	public function createComponentCatalogForm()
	{
		$form = new Form;
		$form->addText('title', 'Název:')
			->addRule(Form::FILLED, "Zadejte název seznamu.")
			->addRule(Form::MIN_LENGTH, "Název musí mít alespoň %s znaků.", 3);
		$form->addSubmit('ok', 'Vytvořit');
		$form->onSuccess[] = $this->success;
		return $form;
	}


	/**
	 * @param Form $form
	 */
	public function success($form)
	{
		$values = $form->getValues();

		$catalog = new Catalog($values);
		$catalog->user = $this->presenter->user->id;

		$this->catalogs->persist($catalog);
		$this->presenter->redirect('this');
	}

}

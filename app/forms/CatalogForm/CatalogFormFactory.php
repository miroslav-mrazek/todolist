<?php

namespace Todolist;

use Nette\Application\UI\Form;


class CatalogFormFactory extends BaseFormFactory
{

	/** @var CatalogRepository */
	protected $catalogRepository;


	public function __construct(CatalogRepository $catalogRepository)
	{
		parent::__construct();
		$this->catalogRepository = $catalogRepository;
	}

	
	/**
	 * @return Form
	 */
	public function create()
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
	}

}

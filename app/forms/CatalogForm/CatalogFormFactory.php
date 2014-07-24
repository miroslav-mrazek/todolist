<?php

namespace Todolist;

use Nette\Application\UI\Form;


class CatalogFormFactory extends Object
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
	public function create($userId)
	{
		$form = new Form;
		$form->addHidden('user')
			->setDefaultValue($userId);
		$form->addText('title', 'Název:')
			->addRule(Form::FILLED, "Zadejte název seznamu.");
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
		$this->catalogRepository->persist($catalog);
		
		$form->setValues(['user' => $values->user], TRUE);
	}

}

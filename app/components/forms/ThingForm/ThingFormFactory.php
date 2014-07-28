<?php

namespace Todolist;

use Nette\Application\UI\Form;


class ThingFormFactory extends Object
{

	/** @var ThingRepository */
	protected $thingRepository;


	public function __construct(ThingRepository $thingRepository)
	{
		parent::__construct();
		$this->thingRepository = $thingRepository;
	}

	
	/**
	 * @return Form
	 */
	public function create($userId)
	{
		$form = new Form;
		$form->addHidden('user')
			->setDefaultValue($userId);
		$form->addText('title', 'Věc:')
			->addRule(Form::FILLED, "Popište záležitost.");
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

		$thing = new Thing($values);
		$this->thingRepository->persist($thing);
		
		$form->setValues(['user' => $values->user], TRUE);
	}

}

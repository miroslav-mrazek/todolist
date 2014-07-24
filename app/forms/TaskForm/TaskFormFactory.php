<?php

namespace Todolist;

use Nette\Application\UI\Form,
	DateTime;


class TaskFormFactory extends Object
{

	/** @var TaskRepository */
	protected $taskRepository;
	

	public function __construct(TaskRepository $taskRepository)
	{
		parent::__construct();
		$this->taskRepository = $taskRepository;
	}
	
	
	/**
	 * @return Form
	 */
	public function create($catalogId)
	{
		$form = new Form;
		$form->addHidden('catalog')
			->setDefaultValue($catalogId);
		$form->addText('text', 'Popis:')
			->addRule(Form::FILLED, "Zadejte popis úkolu.");
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

		$task = new Task($values);
		$task->created = new DateTime;
		$this->taskRepository->persist($task);
		
		$form->setValues(['catalog' => $values->catalog], TRUE);
	}

}

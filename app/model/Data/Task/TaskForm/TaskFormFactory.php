<?php

namespace Todolist;

use Nette\Object,
	Nette\Application\UI\Form,
	DateTime;


class TaskFormFactory extends Object
{

	/** @var TaskRepository */
	protected $taskRepository;
	

	public function __construct(TaskRepository $taskRepository)
	{
		$this->taskRepository = $taskRepository;
	}
	
	
	/**
	 * @return Form
	 */
	public function create($projectId)
	{
		$form = new Form;
		$form->addHidden('project')
			->setDefaultValue($projectId);
		$form->addText('title', 'Název:')
			->addRule(Form::FILLED, "Zadejte název úkolu.");
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
		
		$form->setValues(['project' => $values->project], TRUE);
	}

}

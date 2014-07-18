<?php

namespace Todolist;

use Nette\Application\UI\Form,
	DateTime;


class TaskForm extends BaseControl
{

	/** @var TaskRepository */
	protected $tasks;
	
	/** @var int */
	protected $catalogId;


	public function __construct(TaskRepository $tasks)
	{
		parent::__construct();
		$this->tasks = $tasks;
	}
	
	
	/**
	 * @param int
	 */
	public function setCatalogId($id)
	{
		$this->catalogId = $id;
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/taskForm.latte');
		$this->template->render();
	}
	
	
	/**
	 * @return Form
	 */
	public function createComponentTaskForm()
	{
		$form = new Form;
		$form->addText('text', 'Popis:')
			->addRule(Form::FILLED, "Zadejte popis úkolu.")
			->addRule(Form::MIN_LENGTH, "Popis musí mít alespoň %s znaků.", 5);
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
		$task->catalog = $this->presenter->request->parameters['id']; # TODO: refaktor
		$task->created = new DateTime;

		$this->tasks->persist($task);
		$this->presenter->redirect('this');
	}

}

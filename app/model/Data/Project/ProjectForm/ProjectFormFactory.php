<?php

namespace Todolist;

use Nette\Object,
	Nette\Application\UI\Form;


class ProjectFormFactory extends Object
{

	/** @var ProjectRepository */
	protected $projectRepository;


	public function __construct(ProjectRepository $projectRepository)
	{
		$this->projectRepository = $projectRepository;
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
			->addRule(Form::FILLED, "Zadejte název projektu.");
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

		$project = new Project($values);
		$this->projectRepository->persist($project);
		
		$form->setValues(['user' => $values->user], TRUE);
	}

}

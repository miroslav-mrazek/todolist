<?php

namespace Todolist;


final class ProjectPresenter extends SecuredPresenter
{
	
	use TInjectProjectRepository;
	use TInjectTaskRepository;
	
	use TInjectProjectFormFactory;
	use TInjectTaskFormFactory;
	
	/**
	 * @var Project
	 */
	protected $project;


	/**
	 * @param Project|NULL
	 */
	public function actionList($id = NULL)
	{
		if($id) {
			$this->project = $this->projectRepository->get($id);
		}
	}
	
	public function renderList()
	{
		$this->template->projects = $this->userEntity->projects;
		$this->template->project = $this->project;
	}
	
	
	/**
	 * Signál, který nastaví úkol jako splněný
	 * 
	 * @param int $taskId
	 */
	public function handleSetDone($taskId)
	{
		$task = $this->taskRepository->get($taskId);
		$task->setDone();
		$this->taskRepository->persist($task);
		$this->redirect('this');
	}
	
	/**
	 * Signál, který nastaví úkol jako nesplněný
	 * 
	 * @param int $taskId
	 */
	public function handleSetUndone($taskId)
	{
		$task = $this->taskRepository->get($taskId);
		$task->setUndone();
		$this->taskRepository->persist($task);
		$this->redirect('this');
	}
	
	
	/**
	 * @return ProjectForm
	 */
	public function createComponentProjectForm()
	{
		$form = $this->projectFormFactory->create($this->user->id);
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
		$form = $this->taskFormFactory->create($this->project->id);
		$form->onSuccess[] = function() {
			$this->redirect('this');
		};
		return $form;
	}

}

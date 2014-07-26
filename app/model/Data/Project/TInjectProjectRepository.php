<?php

namespace Todolist;


trait TInjectProjectRepository
{

	/**
	 * @var ProjectRepository
	 */
	protected $projectRepository;
	
	
	public function injectProjectRepository(ProjectRepository $projectRepository)
	{
		$this->projectRepository = $projectRepository;
	}

}

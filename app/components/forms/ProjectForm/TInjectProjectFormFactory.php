<?php

namespace Todolist;


trait TInjectProjectFormFactory
{

	/**
	 * @var ProjectFormFactory
	 */
	protected $projectFormFactory;
	
	
	public function injectProjectFormFactory(ProjectFormFactory $projectFormFactory)
	{
		$this->projectFormFactory = $projectFormFactory;
	}

}

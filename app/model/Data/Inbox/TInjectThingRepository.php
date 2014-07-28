<?php

namespace Todolist;


trait TInjectThingRepository
{

	/**
	 * @var ThingRepository
	 */
	protected $thingRepository;
	
	
	public function injectThingRepository(ThingRepository $thingRepository)
	{
		$this->thingRepository = $thingRepository;
	}

}

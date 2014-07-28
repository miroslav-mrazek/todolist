<?php

namespace Todolist;


trait TInjectThingFormFactory
{

	/**
	 * @var ThingFormFactory
	 */
	protected $thingFormFactory;
	
	
	public function injectThingFormFactory(ThingFormFactory $thingFormFactory)
	{
		$this->thingFormFactory = $thingFormFactory;
	}

}

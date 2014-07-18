<?php

namespace Todolist;


/**
 * Rozhranní pro generovanou továrničku
 */
interface ITaskFormFactory
{

	/**
	 * @return TaskForm
	 */
	function create();

}
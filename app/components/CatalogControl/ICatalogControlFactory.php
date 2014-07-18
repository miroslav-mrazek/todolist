<?php

namespace Todolist;


interface ICatalogControlFactory
{

	/**
	 * @return CatalogControl
	 */
	function create();

}
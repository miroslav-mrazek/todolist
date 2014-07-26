<?php

namespace Todolist;


trait TInjectCatalogControlFactory
{

	/**
	 * @var ICatalogControlFactory
	 */
	protected $catalogControlFactory;
	
	
	public function injectCatalogControlFactory(ICatalogControlFactory $catalogControlFactory)
	{
		$this->catalogControlFactory = $catalogControlFactory;
	}

}

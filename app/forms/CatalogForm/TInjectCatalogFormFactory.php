<?php

namespace Todolist;


trait TInjectCatalogFormFactory
{

	/**
	 * @var CatalogFormFactory
	 */
	protected $catalogFormFactory;
	
	
	public function injectCatalogFormFactory(CatalogFormFactory $catalogFormFactory)
	{
		$this->catalogFormFactory = $catalogFormFactory;
	}

}

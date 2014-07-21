<?php

namespace Todolist;


trait TCatalogFormFactory
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

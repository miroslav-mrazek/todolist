<?php

namespace Todolist;

use Nette\Application\UI\Presenter;


abstract class BasePresenter extends Presenter
{

	public function beforeRender()
	{
		parent::beforeRender();
		$this->template->defaultRoute = RouterFactory::DEFAULT_ROUTE;
	}
	
	
	public function formatTemplateFiles()
	{
		$name = $this->getName();
		$presenter = substr($name, strrpos(':' . $name, ':'));
		$dir = dirname($this->getReflection()->getFileName());
		$templateFiles = [
			"$dir/$this->view.latte",
			"$dir/templates/$this->view.latte",
			"$dir/$presenter.$this->view.latte",
			"$dir/templates/$presenter.$this->view.latte",
		];
		
		$originalTemplateFiles = parent::formatTemplateFiles();
		return array_merge($templateFiles, $originalTemplateFiles);
	}
	
	
	public function formatLayoutTemplateFiles()
	{
		$layoutFiles = [];
		
		$reflection = $this->getReflection();
		while( $reflection->getName() !== 'Nette\Application\UI\Presenter' )
		{
			$dir = dirname($reflection->getFileName());
			$layoutFiles[] = "$dir/@layout.latte";
			$layoutFiles[] = "$dir/templates/@layout.latte";
			
			$reflection = $reflection->getParentClass();
		}
		
		$originalLayoutFiles = parent::formatLayoutTemplateFiles();
		return array_merge($layoutFiles, $originalLayoutFiles);
	}

}

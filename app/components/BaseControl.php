<?php

namespace Todolist;

use Nette\Application\UI\Control,
	Nette\Application\UI\ITemplate;


class BaseControl extends Control
{
	
	public function render()
	{
		$this->template->render();
	}
	
	
	/**
	 * @return ITemplate
	 */
	protected function createTemplate()
	{
		$template = parent::createTemplate();
		
		$dir = dirname($this->reflection->getFileName());
		$name = lcfirst( $this->reflection->getShortName() );
		
		$files = [];
		$files[] = "$dir/$name.latte";
		$files[] = "$dir/templates/$name.latte";
		
		foreach ($files as $file)
		{
			if(file_exists($file))
			{
				$template->setFile($file);
				break;
			}
		}
		
		return $template;
	}
	
}

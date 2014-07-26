<?php

namespace Todolist;

use Nette\Application\UI\Control;


class BaseControl extends Control
{
	
	protected function loadTemplate()
	{
		$dir = dirname($this->reflection->getFileName());
		$name = lcfirst( $this->reflection->getShortName() );
		$file = "$dir/$name.latte";
		$file2 = "$dir/templates/$name.latte";
		$this->template->setFile( file_exists($file) ? $file : $file2 );
	}
	
	
	public function render()
	{
		$this->loadTemplate();
		$this->template->render();
	}
	
}

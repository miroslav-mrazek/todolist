<?php

namespace Todolist;

use Nette\Application\UI\Control;


class BaseControl extends Control
{
	
	protected function prepareTemplate()
	{
		$dir = dirname($this->reflection->getFileName());
		$name = lcfirst( $this->reflection->getShortName() );
		$file = "$dir/$name.latte";
		$file2 = "$dir/templates/$name.latte";
		$this->template->setFile( file_exists($file) ? $file : $file2 );
	}
	
	
	public function render()
	{
		$this->prepareTemplate();
		$this->template->render();
	}
	
	
	public function isAjax()
	{
		return $this->getPresenter()->isAjax();
	}
	
}

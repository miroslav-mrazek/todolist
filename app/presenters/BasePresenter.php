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
}

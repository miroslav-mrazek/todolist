<?php

namespace Todolist;

use Nette\Application\UI\Form;


/**
 * Presenter pro aplikační záležitosti (přihlášení, registrace,…).
 */
class ApplicationPresenter extends BasePresenter
{

	/**
	 * @var ILoginFormFactory
	 * @inject
	 */
	public $loginFormFactory;


	public function renderLogin()
	{
	}


	/**
	 * @return Form
	 */
	protected function createComponentLoginForm()
	{
		return $this->loginFormFactory->create();
	}

}

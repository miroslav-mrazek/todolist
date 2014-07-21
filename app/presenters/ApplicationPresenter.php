<?php

namespace Todolist;

use Exception;


/**
 * Presenter pro aplikační záležitosti (přihlášení, registrace,…).
 */
class ApplicationPresenter extends BasePresenter
{

	use TLoginFormFactory;


	public function renderLogin()
	{
	}


	/**
	 * @return Form
	 */
	protected function createComponentLoginForm()
	{
		$form = $this->loginFormFactory->create();
		$form->onSuccess[] = $this->loginFormSuccess;
		return $form;
	}


	/**
	 * @param Form $form
	 */
	public function loginFormSuccess($form)
	{
		$values = $form->getValues();

		$this->getUser()->setExpiration('+ 14 days', FALSE); # nebudeme automaticky odhlašovat
		try
		{
			$this->getUser()->login($values->username, $values->password);
		}
		catch (Exception $e)
		{
			$this->flashMessage("Zadali jste neznámý email, nebo špatné heslo.", "danger");
			return;
		}

		$this->redirect('Catalog:list');
	}
}

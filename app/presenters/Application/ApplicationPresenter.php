<?php

namespace Todolist;

use Nette\Forms\Form,
	Exception;


/**
 * Presenter pro aplikační záležitosti (přihlášení, registrace,…).
 */
class ApplicationPresenter extends BasePresenter
{

	use TInjectLoginFormFactory;


	public function renderLogin()
	{
	}
	
	
	public function actionLogout()
	{
		$this->getUser()->logout();
		$this->redirect('Application:login');
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
			$form->setValues([], TRUE);
			return;
		}
		$this->redirect(RouterFactory::DEFAULT_ROUTE);
	}
}

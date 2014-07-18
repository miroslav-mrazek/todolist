<?php

namespace Todolist;

use Nette\Application\UI\Form,
	Nette\Security\AuthenticationException;


class LoginForm extends BaseControl
{

	public function render()
	{
		$this->template->setFile(__DIR__ . '/loginForm.latte');
		$this->template->render();
	}


	/**
	 * @return Form
	 */
	protected function createComponentLoginForm()
	{
		$form = new Form;
		$form->addText('username', 'Jméno:')
			->setRequired('Vyplňte, prosím, přihlašovací jméno.');
		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadejte, prosím, heslo.');
		$form->addCheckbox('remember', 'Chci zůstat přihlášený');
		$form->addSubmit('ok', 'Přihlásit se!');
		$form->onSuccess[] = $this->success;
		return $form;
	}


	/**
	 * @param Form $form
	 */
	public function success($form)
	{
		$values = $form->getValues();

		if ($values->remember) {
			$this->presenter->getUser()->setExpiration('+ 14 days', FALSE);
		}
		else {
			$this->presenter->getUser()->setExpiration('+ 20 minutes', TRUE);
		}

		try {
			$this->presenter->getUser()->login($values->username, $values->password);
		}
		catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
			return;
		}

		$this->presenter->redirect('Catalog:list');
	}

}

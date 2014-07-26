<?php

namespace Todolist;

use Nette\Application\UI\Form;
	

class LoginFormFactory extends Object
{

	/**
	 * @return Form
	 */
	function create()
	{
		$form = new Form;
		
		$form->addText('username', 'Jméno:')
			->setRequired('Vyplňte, prosím, přihlašovací jméno.');
		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadejte, prosím, heslo.');
		$form->addSubmit('ok', 'Přihlásit se');

		return $form;
	}

}

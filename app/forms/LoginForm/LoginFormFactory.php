<?php

namespace Todolist;

use Nette\Object,
	Nette\Application\UI\Form;
	

class LoginFormFactory extends Object
{

	/**
	 * @return Form
	 */
	function create()
	{
		$form = new Form;
		
		$form->addText('email', 'Email:')
			->setRequired('Zadejte, prosím, přihlašovací email.')
			->addRule(Form::EMAIL, 'Email nemá správný formát.');
		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadejte, prosím, heslo.');
		$form->addSubmit('ok', 'Přihlásit se');

		return $form;
	}

}

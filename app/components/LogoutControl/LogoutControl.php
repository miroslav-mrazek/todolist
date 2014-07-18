<?php

namespace Todolist;


class LogoutControl extends BaseControl
{

	public function handleLogout()
	{
		$this->presenter->getUser()->logout();
		$this->presenter->flashMessage('Byl jste odhlášen.');
		$this->presenter->redirect('Application:login');
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/logoutControl.latte');
		$this->template->render();
	}


	public function renderButton()
	{
		$this->template->setFile(__DIR__ . '/logoutControlButton.latte');
		$this->template->render();
	}

}

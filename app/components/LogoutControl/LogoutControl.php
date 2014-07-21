<?php

namespace Todolist;


class LogoutControl extends BaseControl
{

	public function handleLogout()
	{
		$this->presenter->getUser()->logout();
		$this->presenter->redirect('Application:login');
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/logoutControl.latte');
		$this->template->render();
	}

}

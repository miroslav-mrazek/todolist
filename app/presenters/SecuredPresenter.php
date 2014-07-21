<?php

namespace Todolist;


/**
 * Presenter, který pustí dál jen přihlášeného uživatele
 */
abstract class SecuredPresenter extends BasePresenter
{
	
	/** @var User */
	protected $userEntity;

	/** @var UserRepository */
	private $users;


	public function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->flashMessage("Začněte tím, že se přihlásíte.");
			$this->redirect('Application:login');
		}
		
		$this->userEntity = $this->users->get($this->user->id);
	}

	
	/**
	 * @param UserRepository $users
	 */
	public function injectUserRepository(UserRepository $users)
	{
		$this->users = $users;
	}

}

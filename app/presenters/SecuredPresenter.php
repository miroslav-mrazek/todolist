<?php

namespace Todolist;


/**
 * Presenter, který pustí dál jen přihlášeného uživatele
 */
abstract class SecuredPresenter extends BasePresenter
{
	
	use TInjectUserRepository;
	
	/** @var User */
	protected $userEntity;


	public function startup()
	{
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$this->flashMessage("Začněte tím, že se přihlásíte.");
			$this->redirect('Application:login');
		}
		
		$this->userEntity = $this->userRepository->get($this->user->id);
	}

}

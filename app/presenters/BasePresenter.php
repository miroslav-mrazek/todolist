<?php

/**
 * TODOLIST
 * Školní projekt k seznámení s Nette a ORM
 * 
 * @author MMR <miroslav.mrazek@gmail.com>
 */

namespace Todolist;

use Nette\Application\UI\Presenter,
	Nette\Security\IAuthorizator;


/**
 * Předek všech presenterů.
 */
abstract class BasePresenter extends Presenter
{
	
	/**
	 * @var Nette\Security\IAuthorizator
	 * @inject 
	 */
	public $authorizator;
	

	/**
	 * Rutiny prováděné při startu aplikace
	 */
	public function startup()
	{
		parent::startup();

		# odstranění $fid z URL, pokud již platnost zprávy vypršela
		if (!empty($this->params[self::FLASH_KEY]) && !$this->hasFlashSession()) {
			unset($this->params[self::FLASH_KEY]);
			$this->redirect('this');
		}
	}

}

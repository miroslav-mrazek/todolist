<?php

namespace Todolist;

use Nette\Application\IRouter,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route;


class RouterFactory
{

	/**
	 * @return IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$router[] = new Route('index.php', 'Catalog:list', Route::ONE_WAY);
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Catalog:list');
		return $router;
	}

}

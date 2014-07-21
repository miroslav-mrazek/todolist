<?php

namespace Todolist;

use Nette\Application\IRouter,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route;


class RouterFactory
{
	
	const DEFAULT_ROUTE = 'Catalog:list';

	
	/**
	 * @return IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		
		# jednosměrná routa pro zpracování přímého volání souboru index.php
		$router[] = new Route('index.php', self::DEFAULT_ROUTE, Route::ONE_WAY);
		
		# zkratky
		$router[] = new Route('login', 'Application:login');
		$router[] = new Route('logout', 'Application:logout');
		
		$router[] = new Route('<presenter>/<action>[/<id>]', self::DEFAULT_ROUTE);
		
		return $router;
	}

}

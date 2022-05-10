<?php

declare(strict_types=1);

namespace App;

use Nette\StaticClass;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class RouterFactory
{
	use StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router[] = new Route('login', 'Authentication:login');
		$router[] = new Route('logout', 'Authentication:logout');
		$router[] = new Route('callback', 'Authentication:callback');
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;
	}
}

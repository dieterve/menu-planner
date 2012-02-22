<?php

namespace Application;

/**
 * This is our core application class. It will start the application and
 * kickstart the right controllers.
 *
 * @author Dieter Vanden Eynde <dieter@dieterve.be>
 */
class Application
{
	/**
	 * Application router.
	 *
	 * @var	Router
	 */
	private $router;

	/**
	 * Add a route and the controller to map it too.
	 *
	 * @param string $route
	 * @param string $controller
	 * @param string[optional] $action
	 */
	public function addRoute($route, $controller, $action = 'execute')
	{
		$this->router->map($route, function() use ($controller, $action)
		{
			// params extracted from the URL by the router
			$params = func_get_args();

			// @todo find a non-static way to call the controller with the params from the router
		});
	}

	/**
	 * Run the application with all its magic.
	 */
	public function run()
	{
		$this->router->process();
	}

	/**
	 * Router to use for the application

	 * @param Router $router
	 */
	public function setRouter(Router $router)
	{
		$this->router = $router;
	}
}

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
	 * Dependency container
	 *
	 * @var	Container
	 */
	private $container;

	/**
	 * Application router.
	 *
	 * @var	Router
	 */
	private $router;

	/**
	 * @param Router $router
	 */
	public function __construct(Router $router, Container $container)
	{
		$this->container = $container;
		$this->router = $router;
	}

	/**
	 * Add a route and the controller to map it too.
	 *
	 * @param string $route
	 * @param string $controller
	 * @param string $action Action to call inside the controller.
	 */
	public function addRoute($route, $controller, $action = null)
	{
		$container = $this->container;
		$this->router->map($route, function() use ($controller, $action, $container)
		{
			// params extracted by the router
			$params = func_get_args();

			// execute the specified action
			$object = new $controller($container);
			call_user_func_array(array($object, $action), $params);
		});
	}

	/**
	 * Run the application with all its magic.
	 */
	public function run()
	{
		$this->router->process();
	}
}

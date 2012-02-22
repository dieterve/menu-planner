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

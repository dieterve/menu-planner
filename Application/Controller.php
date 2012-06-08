<?php

namespace Application;

/**
 * Base controller class which will be extended by all other controllers.
 *
 * @author Dieter Vanden Eynde <dieter@dieterve.be>
 */
class Controller
{
	/**
	 * Dependency container
	 *
	 * @var	Container
	 */
	protected $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}
}
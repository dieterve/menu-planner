<?php

namespace Application;

/**
 * The router will map a path to a callback.
 *
 * @later create a Router interface
 *
 * @author Dieter Vanden Eynde <dieter@dieterve.be>
 */
class Router
{
	/**
	 * Start mapping from this path.
	 *
	 * This is needed when the application is placed in a subdirectory instead
	 * of the document root.
	 *
	 * For example:
	 * http://site/something (basePath = 'something')
	 * http://site/ (basePath = '')
	 *
	 * @var string
	 */
	private $basePath;

	/**
	 * Routes with corresponding callbacks by priority.
	 *
	 * @var array
	 */
	private $routes;

	/**
	 * @param string $basePath
	 */
	public function __construct($basePath = '')
	{
		$this->setBasePath($basePath);
	}

	/**
	 * @param string $basePath
	 */
	public function setBasePath($basePath)
	{
		$this->basePath = (string) $basePath;
	}

	/**
	 * @return string
	 */
	public function getBasePath()
	{
		return $this->basePath;
	}

	/**
	 * Get the path used the access the application.
	 * This will be the actual application path without the base path.
	 *
	 * @return string
	 */
	public function getPath()
	{
		$path = $_SERVER['REQUEST_URI'];

		// strip the query string
		if(mb_stripos($path, '?') !== false)
		{
			$path = mb_substr($path, 0, mb_stripos($path, '?'));
		}

		// @later strip the base path from the *beginning* of the path

		// strip the trailing slash (we do want the starting slash)
		if(mb_strlen($path) > 1) $path = rtrim($path, '/');

		return $path;
	}

	/**
	 * Map a route to a callback function.
	 *
	 * @param string $route
	 * @param mixed $callback
	 */
	public function map($route, $callback)
	{
		$this->routes[] = array(
			'route' => $route,
			'callback' => $callback
		);
	}

	/**
	 * Match all routes with the current URL, execute the callback of the matched route.
	 * Stops processing when one route matches.
	 */
	public function process()
	{
		$path = $this->getPath();

		foreach($this->routes as $route)
		{
			if($route['route'] == $path)
			{
				$route['callback']();
			}
		}
	}
}
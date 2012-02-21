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
	 * Build a regular expression for a route.
	 *
	 * @param string $route
	 * @return string
	 */
	public function buildRouteRegex($route)
	{
		$regex = $route;
		$regex = str_ireplace('/', '\/', $regex);
		$regex = preg_replace('/(:[a-zA-Z0-9]+)/', '([^\/]+)', $regex);
		$regex = '/^' . $regex . '/i';

		return $regex;
	}

	/**
	 * @param string $basePath
	 */
	public function setBasePath($basePath)
	{
		$this->basePath = rtrim((string) $basePath, '/');
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

		// strip the base path from the *beginning* of the path
		if(mb_stripos('@@@' . $path, '@@@' . $this->getBasePath()) !== false)
		{
			$path = mb_substr($path, mb_strlen($this->getBasePath()));
		}

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
			'regex' => $this->buildRouteRegex($route),
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
			$matches = array();
			if(preg_match($route['regex'], $path, $matches))
			{
				// remove the full pattern
				array_shift($matches);

				call_user_func_array($route['callback'], $matches);
			}
		}
	}
}
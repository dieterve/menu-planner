<?php

namespace Application;

/**
 * Autoloader class to register namespaces with.
 *
 * @author Dieter Vanden Eynde <dieter@dieterve.be>
 */
class Autoloader
{
	/**
	 * @var array
	 */
	private $namespaces = array();

	/**
	 * Require a class in the registered namespaces.
	 *
	 * @param string $class
	 */
	public function loadClass($class)
	{
		$class = (string) $class;

		foreach($this->namespaces as $namespace => $path)
		{
			if(stripos($class, $namespace) !== false)
			{
				$file = $path . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

				if(file_exists($file))
				{
					require_once($file);
					break;
				}
			}
		}
	}

	/**
	 * Register this autoloader class with SPL.
	 */
	public function register()
	{
		spl_autoload_register(array($this, 'loadClass'));
	}

	/**
	 * @param string $namespace
	 * @param string $path
	 */
	public function registerNamespace($namespace, $path)
	{
		$this->namespaces[(string) $namespace] = (string) $path;
	}

	/**
	 * Register namespaces in bulk.
	 * Format:
	 * array(
	 * 	'Namespace' => '/path/to/namespace',
	 * 	'Namespace\Sub' => '/path/to/sub',
	 * );
	 *
	 * @param array $namespaces
	 */
	public function registerNamespaces(array $namespaces)
	{
		foreach($namespaces as $namespace => $path)
		{
			$this->registerNamespace($namespace, $path);
		}
	}
}

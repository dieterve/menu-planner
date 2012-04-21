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
	 * @var array
	 */
	private $prefixes = array();

	/**
	 * Require a class in the registered namespaces.
	 *
	 * @param string $class
	 */
	public function loadClass($class)
	{
		$class = (string) $class;
		$file = '';

		// namespace based class
		if(strpos($class, '\\') !== false)
		{
			foreach($this->namespaces as $namespace => $path)
			{
				if(stripos($class, $namespace) !== false)
				{
					$file = $path . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
					break;
				}
			}
		}

		// prefix based class
		else
		{
			foreach($this->prefixes as $prefix => $path)
			{
				if(stripos($class, $prefix) !== false)
				{
					$file = $path . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
					break;
				}
			}
		}

		if($file != '' && file_exists($file))
		{
			require_once($file);
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
	 * Register the location of a namespace so it can be autoloaded.
	 *
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

	/**
	 * Register the lcoation of classes starting with a given prefix.
	 * PEAR namingconventions use this.
	 *
	 * @param string $prefix
	 * @param string $path
	 */
	public function registerPrefix($prefix, $path)
	{
		$this->prefixes[(string) $prefix] = (string) $path;
	}

	/**
	 * Register prefixes in bulk.
	 * Format:
	 * array(
	 * 	'Prefix' => '/path/to/prefix',
	 * 	'Prefix_Sub' => '/path/to/sub',
	 * );
	 *
	 * @param array $prefixes
	 */
	public function registerPrefixes(array $prefixes)
	{
		foreach($prefixes as $prefix => $path)
		{
			$this->registerPrefix($prefix, $path);
		}
	}
}

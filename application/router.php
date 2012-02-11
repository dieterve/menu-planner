<?php

namespace Application;

/**
 * The router will map a URL to a callback.
 *
 * @later create an Router interface and create an UrlRouter and CmdRouter class
 *
 * @author Dieter Vanden Eynde <dieter@dieterve.be>
 */
class Router
{
	/**
	 * Start mapping from this path.
	 *
	 * For example:
	 * http://site/something (basePath = 'something')
	 * http://site/ (basePath = '')
	 *
	 * @var string
	 */
	private $basePath;

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
}
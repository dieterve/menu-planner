<?php

/**
 * Autoloader
 *
 * Lets assume for now that our directory structure matches our namespace/class naming.
 *
 * For example:
 * Application\Router is located at application/router.php
 *
 * @author Dieter Vanden Eynde <dieter@dieterve.be>
 * @param string
 */
function autoLoader($className)
{
	$chunks = explode('\\', $className);

	$path = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $chunks) . '.php';

	if(@file_exists($path))
	{
		require_once($path);
	}
}

spl_autoload_register('autoLoader');

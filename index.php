<?php

/*
 * Autoloader
 *
 * Lets assume for now that our directory structure matches our namespace/class naming.
 *
 * For example:
 * Application\Router is located at application/router.php
 */
function autoLoader($className)
{
	$chunks = explode('\\', $className);
	$chunks = array_map('strtolower', $chunks);

	$path = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $chunks) . '.php';

	if(@file_exists($path))
	{
		require_once($path);
	}
}
spl_autoload_register('autoLoader');

$router = new Application\Router();

$router->map('/user', function()
{
	var_dump('user');
	exit;
});

$router->map('/', function()
{
	var_dump('home');
	exit;
});

$router->process();

echo 'Hello world. Yes, I am actually doing this.';
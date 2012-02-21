<?php

require_once('autoload.php');

$router = new Application\Router();

$router->map('/user/:user/:action', function($user, $action)
{
	var_dump('user:' . $user);
	var_dump('action:' . $action);
	exit;
});

$router->map('/user/:user', function($user)
{
	var_dump('user:' . $user);
	exit;
});

$router->map('/user', function()
{
	var_dump('user');
	exit;
});

$router->map('/:path', function($path)
{
	var_dump('404 Could not find: ' . $path);
	exit;
});

$router->map('/', function()
{
	var_dump('home');
	exit;
});

$router->process();

echo 'Hello world. Yes, I am actually doing this.';

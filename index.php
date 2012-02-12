<?php

require_once('autoload.php');

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

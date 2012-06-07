<?php

require_once('../autoload.php');

use \Application\Application;
use \Application\Router;
use \Application\Container;

$container = new Container();
$container->template = function($container)
{
	$loader = new Twig_Loader_Filesystem(dirname(__FILE__) . '/../');
	$twig = new Twig_Environment($loader);

	return $twig;
};

$application = new Application(new Router(), $container);

// routes
$application->addRoute('/', '\Modules\Menu\Controller\Index', 'showIndex');

// Go Go Powerrangers!
$application->run();

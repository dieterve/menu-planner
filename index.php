<?php

require_once('autoload.php');

use \Application\Application;
use \Application\Router;

$application = new Application();
$application->setRouter(new Router());

// routes
$application->addRoute('/', '\Modules\Menu\Controller\Index');

$application->run();

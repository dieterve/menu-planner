<?php

require_once('autoload.php');

use \Application\Application;
use \Application\Router;

$application = new Application();
$application->setRouter(new Router());

$application->addRoute('/user/:user', '\Modules\Menu\Controller\Index');

$application->run();

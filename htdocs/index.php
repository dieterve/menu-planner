<?php

require_once('../autoload.php');

use \Application\Application;
use \Application\Router;

$application = new Application(new Router());

// routes
$application->addRoute('/', '\Modules\Menu\Controller\Index', 'showIndex');

// Go Go Powerrangers!
$application->run();

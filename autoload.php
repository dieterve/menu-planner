<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Application/Autoloader.php';

use Application\Autoloader;

$autoloader = new Autoloader();

$autoloader->registerNamespace('Application', __DIR__);
$autoloader->registerNamespace('Modules', __DIR__);

$autoloader->register();

<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Application/Autoloader.php';

use Application\Autoloader;

$autoloader = new Autoloader();

$autoloader->registerNamespace('Application', __DIR__);
$autoloader->registerNamespace('Modules', __DIR__);
$autoloader->registerPrefix('Twig', __DIR__ . '/vendor/twig/lib');

$autoloader->register();

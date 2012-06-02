<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Application/Autoloader.php';

use Application\Autoloader;

$autoloader = new Autoloader();

$autoloader->registerNamespace('Application', __DIR__);
$autoloader->registerNamespace('Modules', __DIR__);

/*
 * Add vendor maps created by Composer.
 *
 * I do not use the autoloader because its much more cooler to use my own shit.
 * Also, I just wanted to learn it myself.
 * Also, I dont like stacking too	 many SPL autoloaders.
 */
$composerDir = __DIR__ . '/vendor/composer';
$autoloader->registerNamespaces(require $composerDir . '/autoload_namespaces.php');
$autoloader->registerNamespaces(require $composerDir . '/autoload_classmap.php');

$autoloader->register();

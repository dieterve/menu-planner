<?php

require_once '../autoload.php';
require_once 'PHPUnit/Framework/TestCase.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
	public function testPath()
	{
		$router = new Application\Router();

		$_SERVER['REQUEST_URI'] = '/';
		$this->assertEquals('/', $router->getPath());
		$_SERVER['REQUEST_URI'] = '/path';
		$this->assertEquals('/path', $router->getPath());
		$_SERVER['REQUEST_URI'] = '/path/';
		$this->assertEquals('/path', $router->getPath());
		$_SERVER['REQUEST_URI'] = '/path/deeper';
		$this->assertEquals('/path/deeper', $router->getPath());

		$_SERVER['REQUEST_URI'] = '/?param1=test';
		$this->assertEquals('/', $router->getPath());
		$_SERVER['REQUEST_URI'] = '/path/deeper?param1=test';
		$this->assertEquals('/path/deeper', $router->getPath());
		$_SERVER['REQUEST_URI'] = '/path/deeper/?param1=test';
		$this->assertEquals('/path/deeper', $router->getPath());
		$_SERVER['REQUEST_URI'] = '/path/deeper?param1=test&param2=more';
		$this->assertEquals('/path/deeper', $router->getPath());
	}

	public function testMapping()
	{
		$router = new Application\Router();
		$router->map('/path', function()
		{
			echo 'path';
		});
		$this->checkResponse($router, '/path', 'path');
		$this->checkResponse($router, '/path?param1=test', 'path');
		$this->checkResponse($router, '/unrelated?param1=test', '');

		$router = new Application\Router();
		$router->map('/user/:user', function($user)
		{
			echo $user;
		});
		$this->checkResponse($router, '/user', '');
		$this->checkResponse($router, '/user/dieter', 'dieter');
		$this->checkResponse($router, '/user/dieter?param1=test', 'dieter');
		$this->checkResponse($router, '/user/dieter/photos?param1=test', 'dieter');

		$router = new Application\Router();
		$router->map('/user/:user/:action', function($user, $action)
		{
			echo $user . '-' . $action;
		});
		$this->checkResponse($router, '/user', '');
		$this->checkResponse($router, '/user/dieter', '');
		$this->checkResponse($router, '/user/dieter/photos', 'dieter-photos');
		$this->checkResponse($router, '/user/dieter/photos?param1=test', 'dieter-photos');
	}

	public function testMappingWithBasePath()
	{
		$router = new Application\Router('/subdir');
		$router->map('/path', function()
		{
			echo 'path';
		});
		$this->checkResponse($router, '/subdir/path', 'path');
		$this->checkResponse($router, '/subdir/path?param1=test', 'path');
		$this->checkResponse($router, '/subdir/unrelated?param1=test', '');
	}

	private function checkResponse($router, $uri, $expectedOutput)
	{
		$_SERVER['REQUEST_URI'] = $uri;

		ob_start();
		$router->process();
		$output = ob_get_clean();

		$this->assertEquals($expectedOutput, $output);
	}
}

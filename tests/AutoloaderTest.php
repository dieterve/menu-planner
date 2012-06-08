<?php

require_once dirname(__FILE__) . '/../autoload.php';
require_once 'PHPUnit/Framework/TestCase.php';

class AutoloaderTest extends PHPUnit_Framework_TestCase
{
	public function testFailures()
	{
		$this->assertFalse(class_exists('\Application\Fake'));
		$this->assertFalse(class_exists('Ronny'));
	}

	public function testSuccess()
	{
		$this->assertTrue(class_exists('\Application\Router'));
	}
}

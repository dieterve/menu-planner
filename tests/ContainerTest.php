<?php

require_once dirname(__FILE__) . '/../autoload.php';
require_once 'PHPUnit/Framework/TestCase.php';

class ContainerTest extends PHPUnit_Framework_TestCase
{
	private $container;

	public function setUp()
	{
		$this->container = new Application\Container();
	}

	public function testParameters()
	{
		$this->container->username = 'dieter';
		$this->assertSame('dieter', $this->container->username);

		$this->container->number = 12345;
		$this->assertSame(12345, $this->container->number);

		$this->container->hobbies = array('running', 'hiking');
		$this->assertSame(array('running', 'hiking'), $this->container->hobbies);
	}

	public function testClosures()
	{
		/*
		 * Test if a closure is executed when accessed.
		 */
		$this->container->whatTimeIsIt = function()
		{
			return 'PartyOClock';
		};
		$this->assertEquals('PartyOClock', $this->container->whatTimeIsIt);

		/*
		 * Test if the Container instance is passed to each closure.
		 */
		$this->container->connection = 'connection;info';
		$this->container->connectionString = function($container)
		{
			return $container->connection;
		};
		$this->assertEquals('connection;info', $this->container->connectionString);
	}
}

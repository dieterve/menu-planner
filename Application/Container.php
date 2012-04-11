<?php

namespace Application;

/**
 * Dependency container.
 *
 * Based on a presentation of Fabien Potencier.
 *
 * @author Dieter Vanden Eynde <dieter@dieterve.be>
 */
class Container
{
	/**
	 * @var array
	 */
	protected $values = array();

	public function __get($name)
	{
		if(!array_key_exists($name, $this->values))
		{
			throw new Exception('Value ' . $name . ' is not set.');
		}

		// call if its an instance or closure
		if(is_callable($this->values[$name]))
		{
			return $this->values[$name]($this);
		}

		// static stored value
		else
		{
			return $this->values[$name];
		}
	}

	public function __set($name, $value)
	{
		$this->values[$name] = $value;
	}
}

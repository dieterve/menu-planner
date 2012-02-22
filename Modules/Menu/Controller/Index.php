<?php

namespace Modules\Menu\Controller;

class Index
{
	public function execute($param1, $param2)
	{
		var_dump($param1);
		var_dump($param2);
		var_dump(__METHOD__);
	}
}
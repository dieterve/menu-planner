<?php

namespace Modules\Menu\Controller;

use \Application\Controller;

/**
 * Homepage controller.
 *
 * @author Dieter Vanden Eynde <dieter@netlash.com>
 */
class Index extends Controller
{
	public function showIndex()
	{
		$this->container->template->display('/Modules/Menu/View/Index.tpl', array('animal' => 'dog'));
	}
}
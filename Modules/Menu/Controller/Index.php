<?php

namespace Modules\Menu\Controller;

/**
 * Homepage controller.
 *
 * @author Dieter Vanden Eynde <dieter@netlash.com>
 */
class Index
{
	public function showIndex()
	{
		$loader = new \Twig_Loader_Filesystem(dirname(__FILE__));
		$twig = new \Twig_Environment($loader);

		echo $twig->render('/../View/Index.tpl', array('animal' => 'dog'));
	}
}
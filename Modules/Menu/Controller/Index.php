<?php

namespace Modules\Menu\Controller;

/**
 * Homepage controller.
 *
 * @author Dieter Vanden Eynde <dieter@netlash.com>
 */
class Index
{
	public function __construct()
	{
		$loader = new \Twig_Loader_String();
		$twig = new \Twig_Environment($loader);

		echo $twig->render('Home is where my {{ animal }} is!', array('animal' => 'dog'));
	}
}
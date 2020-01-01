<?php

/**
 * Neko Framework View Engine Class
 * --------------------------------------
 * This class is only for Neko framework
 */

namespace Neko\Twig;

use Neko\Framework\App;
use Neko\Framework\View\ViewEngineInterface;

class ViewEngine implements ViewEngineInterface {

	protected $app;

	public function __construct(App $app)
	{
		$this->app = $app;
	}

	/**
	 * Render view file with twig factory
	 *
	 * @param string $file
	 * @param array $data
	 * @return string rendered view
	 */
	public function render($file, array $data = [])
	{
		return $this->app->twig->render($file, $data);
	}

}

<?php

/**
 * Provider Class for Neko Framework
 * --------------------------------------
 * This class is only for Neko framework
 */

namespace Neko\Twig;

use Neko\Framework\App;
use Neko\Framework\Provider;

class NekoTwigProvider extends Provider {

	/**
	 * Register twig instance on application booting
	 */
	public function register()
	{
		$app = $this->app;
		$app['twig'] = $app->container->singleton(function($container) use ($app) {
			$view_paths = [$app->config->get('app.path')."themes/".$app->config->get('user_theme')];
			$view_cache_path = $app->config->get('app.path')."themes/_cache";

			$twig = new Twig($view_paths, $view_cache_path);
			return $twig;
		});

		//$app->config['view.engine'] = new TwigViewEngine($app);
	}

	/**
	 * Register view macro on application booting
	 */
	public function boot()
	{
		$app = $this->app;

		$app->macro('twig', function($file, array $data = []) use ($app) {
			return $app->twig->render($file, $data);
		});
	}

}

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
	 * Register blade instance on application booting
	 */
	public function register()
	{
		$app = $this->app;
		$app['blade'] = $app->container->singleton(function($container) use ($app) {
			$view_paths = [$app->config->get('app.path')."themes/".$app->config->get('user_theme')];
			$view_cache_path = $app->config->get('app.path')."themes/_cache";

			$blade = new Twig($view_paths, $view_cache_path);
			return $blade;
		});

		//$app->config['view.engine'] = new TwigViewEngine($app);
	}

	/**
	 * Register view macro on application booting
	 */
	public function boot()
	{
		$app = $this->app;

		$app->macro('blade', function($file, array $data = []) use ($app) {
			return $app->blade->render($file, $data);
		});
	}

}

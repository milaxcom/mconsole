<?php

namespace Milax\Mconsole\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class MconsoleServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		require __DIR__ . '/../Http/routes.php';
		
		// Resources
		$this->loadTranslationsFrom(__DIR__ . '/../../../resources/lang', 'mconsole');
		$this->loadViewsFrom(__DIR__ . '/../../../resources/views', 'mconsole');
		
		// Assets
		$this->publishes([
			__DIR__ . '/../../../../public' => base_path('public/massets'),
		], 'assets');
		
		// Copy database migrations
		$migrations = [];
		$dir = __DIR__ . '/../../../migrations/';
		collect(scandir(__DIR__ . '/../../../migrations'))->each(function ($file) use (&$dir, &$migrations) {
			if (strpos($file, '.php') !== false)
				$migrations[$dir . $file] = base_path('database/migrations/' . $file);
		});
		$this->publishes($migrations, 'migrations');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['router']->middleware('mconsole', 'Milax\Mconsole\Http\Middleware\MconsoleMiddleware');
		$this->app->register(\Intervention\Image\ImageServiceProvider::class);
		$this->app->register(\Milax\Mconsole\Providers\MconsoleBladeExtensions::class);
		$this->app->register(\Milax\Mconsole\Providers\CommandsServiceProvider::class);
		
		AliasLoader::getInstance()->alias('Gravatar', \Milax\Gravatar::class);
		AliasLoader::getInstance()->alias('Image', \Intervention\Image\Facades\Image::class);
	}

}

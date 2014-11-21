<?php namespace Ifnot\Renderable;

use Illuminate\Support\ServiceProvider;
use View;
use Config;

class RenderableServiceProvider extends ServiceProvider {

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
		$this->package('ifnot/renderable');

        View::addNamespace('ifnot.renderable', realpath(__DIR__.'/../../views'));
        Config::addNamespace('ifnot.renderable', realpath(__DIR__.'/../../config'));
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

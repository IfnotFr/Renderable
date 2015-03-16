<?php namespace Ifnot\Renderable;

use Illuminate\Support\ServiceProvider;
use Ifnot\Renderable\Renderer;
use View;
use Config;

/**
 * Class RenderableServiceProvider
 * @package Ifnot\Renderable
 */
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
		$this->package('ifnot/renderable', 'ifnot.renderable');

        View::addNamespace('ifnot.renderable', realpath(__DIR__.'/../../views'));

		Renderer::$globalMode = Config::get('ifnot.renderable::config.global_mode');
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

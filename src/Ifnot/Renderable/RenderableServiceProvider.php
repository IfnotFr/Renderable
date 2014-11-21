<?php namespace Ifnot\Renderable;

use Illuminate\Support\ServiceProvider;
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

        Model\Renderer::$defaultRenderingMode = Config::get('ifnot.renderable::config.default_rendering_mode');
        Model\Renderer::$defaultModelRenderers = Config::get('ifnot.renderable::config.default_model_renderers');
        Model\Renderer::$defaultPropertyRenderers = Config::get('ifnot.renderable::config.default_property_renderers');
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

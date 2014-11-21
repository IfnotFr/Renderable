<?php namespace Ifnot\Renderable;

use Ifnot\Renderable\Model\Renderer;
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
		$this->package('ifnot/renderable', 'ifnot.renderable');

        View::addNamespace('ifnot.renderable', realpath(__DIR__.'/../../views'));

        Renderer::$defaultRenderingMode = Config::get('ifnot.renderable::config.default_rendering_mode');
        Renderer::$defaultModelRenderers = Config::get('ifnot.renderable::config.default_model_renderers');
        Renderer::$defaultAttributeRenderers = Config::get('ifnot.renderable::config.default_attribute_renderers');
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

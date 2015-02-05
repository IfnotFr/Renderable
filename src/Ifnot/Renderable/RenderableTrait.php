<?php namespace Ifnot\Renderable;

use Ifnot\Renderable\Exceptions\RendererException;

/**
 * Class RenderableTrait
 * @package Ifnot\Renderable
 */
trait RenderableTrait {
	/**
	 * View renderer instance
	 *
	 * @var mixed
	 */
	protected $rendererInstance;

	/**
	 * Prepare a new or cached renderer instance
	 *
	 * @param array $options
	 * @return mixed
	 * @throws RendererException
	 */
	public function render($mode = null)
	{
		if (!$this->renderer or !class_exists($this->renderer))
		{
			throw new RendererException('Please set the $renderer property to your renderer path.');
		}

		if (!$this->rendererInstance)
		{
			$this->rendererInstance = new $this->renderer($this, $mode);
		}

		return $this->rendererInstance;
	}
}
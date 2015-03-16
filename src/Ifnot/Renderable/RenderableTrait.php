<?php namespace Ifnot\Renderable;

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
	 * @throws \Exception
	 */
	public function render($mode = null)
	{
		if (!$this->renderer or !class_exists($this->renderer))
		{
			throw new \Exception('Please set the $renderer property to your renderer path.');
		}

		if (!$this->rendererInstance)
		{
			$this->rendererInstance = new $this->renderer($this, $mode);
		}

		return $this->rendererInstance;
	}
}
<?php namespace Ifnot\Renderable;

use Ifnot\Renderable\Exceptions\RendererException;
use Ifnot\Renderable\Traits\ModelRendererTrait;
use Ifnot\Renderable\Traits\PropertyRendererTrait;

/**
 * Class Renderer
 * @package Ifnot\Renderable
 */
class Renderer {
	use ModelRendererTrait;
	use PropertyRendererTrait;

	public static $globalMode;

	/**
	 * @var mixed
	 */
	protected $entity;
	protected $mode;

	/**
	 * @param      $entity
	 * @param null $mode
	 */
	function __construct($entity, $mode = null)
	{
		// Default mode
		if(is_null($mode))
			$mode = self::$globalMode;

		$this->entity = $entity;
		$this->mode = $mode;
	}

	/**
	 * @return mixed
	 */
	protected function getEntity()
	{
		return $this->entity;
	}

	/**
	 * @param $type
	 *
	 * @throws RendererException
	 */
	protected function testRenderableConfiguration($type)
	{
		if(!isset($this->renderable) OR !isset($this->renderable[$type]))
			throw new RendererException("No renderable configuration found into your renderer object " . get_class($this) . " (type : $type). Please fill up a " . '$renderable' . " property into your object.");

		if(!isset($this->renderable[$type][$this->mode]))
			throw new RendererException("No configuration found for renderable mode " . $this->mode . " into your renderable object " . get_class($this) . " (type : $type).");
	}
}
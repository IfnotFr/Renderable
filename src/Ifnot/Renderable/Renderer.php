<?php namespace Ifnot\Renderable;

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
	public function __construct($entity, $mode = null)
	{
		// Default mode
		if(is_null($mode))
			$mode = self::$globalMode;

		$this->entity = $entity;
		$this->mode = $mode;
	}

	/**
	 * @param $type
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function getRenderable($type)
	{
		if(isset($this->renderable) AND isset($this->renderable[$type]) AND isset($this->renderable[$type][$this->mode]))
			return $this->renderable[$type][$this->mode];

		else
			throw new \Exception("No configuration found for renderable mode " . $this->mode . " into your renderable object " . get_class($this) . " (type : $type).");

	}

	/**
	 * @return mixed
	 */
	protected function getEntity()
	{
		return $this->entity;
	}
}
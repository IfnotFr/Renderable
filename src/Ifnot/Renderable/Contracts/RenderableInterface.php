<?php namespace Ifnot\Renderable\Contracts;

/**
 * Interface RenderableInterface
 * @package Ifnot\Renderable\Contracts
 */
interface RenderableInterface {

	/**
	 * Prepare a new or cached renderable instance
	 *
	 * @return mixed
	 */
	public function render();

} 
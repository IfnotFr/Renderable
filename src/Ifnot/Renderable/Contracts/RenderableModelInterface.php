<?php namespace Ifnot\Renderable\Contracts;

/**
 * Interface RenderableModelInterface
 * @package Ifnot\Renderable\Contracts
 */
interface RenderableModelInterface {

	/**
	 * Prepare a new or cached renderable instance
	 *
	 * @return mixed
	 */
	public function render();

} 
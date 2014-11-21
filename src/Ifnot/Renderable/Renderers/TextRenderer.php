<?php namespace Ifnot\Renderable\Renderers;

/**
 * Class TextRenderer
 * @package Ifnot\Renderable\Renderers
 */
class TextRenderer extends BaseRenderer {
	protected $options = [
		'view' => [
            'show' => 'ifnot.renderable::renderer.attribute.text'
        ]
	];
}
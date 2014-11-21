<?php namespace Ifnot\Renderable\Renderers\Property;

/**
 * Class TextRenderer
 * @package Ifnot\Renderable\Renderers\Property
 */
class TextRenderer extends BaseRenderer {
	protected $options = [
		'view' => [
            'show' => 'ifnot.renderable::renderer.attribute.text'
        ]
	];
}
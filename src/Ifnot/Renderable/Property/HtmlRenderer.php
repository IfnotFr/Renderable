<?php namespace Ifnot\Renderable\Renderers\Property;

/**
 * Class HtmlRenderer
 * @package Ifnot\Renderable\Renderers\Property
 */
class HtmlRenderer extends BaseRenderer {
	protected $options = [
		'view' => [
            'show' => 'ifnot.renderable::renderer.attribute.html'
        ]
	];
}
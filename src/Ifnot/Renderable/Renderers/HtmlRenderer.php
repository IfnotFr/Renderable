<?php namespace Ifnot\Renderable\Renderers;

/**
 * Class HtmlRenderer
 * @package Ifnot\Renderable\Renderers
 */
class HtmlRenderer extends BaseRenderer {
	protected $options = [
		'view' => [
            'show' => 'ifnot.renderable::renderer.attribute.html'
        ]
	];
}
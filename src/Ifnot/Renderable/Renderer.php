<?php namespace Ifnot\Renderable;

/**
 * Class Renderer
 * @package Ifnot\Renderable
 */
abstract class Renderer {
    protected $defaultRenderer = 'Ifnot\Renderable\Renderers\HtmlRenderer';

    /**
     * @var mixed
     */
    protected $entity;

    /**
     * @param $entity
     */
    function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Allow for property-style retrieval
     *
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property))
        {
            return $this->{$property}();
        }

        return $this->entity->{$property};
    }

    protected function render($attribute, $rendererClass = null, $options = [])
    {
        if(is_null($rendererClass)) $rendererClass = $this->defaultRenderer;
        $attrRenderer = new $rendererClass($this->entity, $attribute, $options);
    }
} 
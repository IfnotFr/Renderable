<?php namespace Ifnot\Renderable;

/**
 * Class ModelRenderer
 * @package Ifnot\Renderable
 */
abstract class ModelRenderer {
    protected $defaultRenderer = 'Ifnot\Renderable\Renderers\HtmlRenderer';
    protected $options = [
        'view' => 'ifnot.renderable::renderer.model.html'
    ];

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

        return $this->render($property);
    }

    /**
     * @param $attribute
     * @param null $rendererClass
     * @param array $options
     */
    protected function render($attribute, $rendererClass = null, $options = [])
    {
        if(is_null($rendererClass)) $rendererClass = $this->defaultRenderer;

        $renderer = new $rendererClass($this->entity, $attribute, $options);

        return $renderer->__toString();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function __toString()
    {
        return \View::make($this->options['view'], [
            'entity' => $this->entity
        ]);
    }
} 
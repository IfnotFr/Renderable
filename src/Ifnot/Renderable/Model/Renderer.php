<?php namespace Ifnot\Renderable\Model;

use Ifnot\Renderable\Exceptions\RendererException;
use Config;
use View;

/**
 * Class Renderer
 * @package Ifnot\Renderable\Model
 */
abstract class Renderer {
    protected $mode = 'show';

    public static $defaultRenderingMode;
    public static $defaultModelRenderers;
    public static $defaultPropertyRenderers;

    /**
     * @var mixed
     */
    protected $entity;

    /**
     * @param $entity
     */
    function __construct($entity, $mode = null)
    {
        // Default mode
        if(is_null($mode))
            $mode = self::$defaultRenderingMode;

        $this->entity = $entity;
        $this->mode = $mode;

        // Default model renderers
        if(!property_exists($this, 'renderers'))
            $this->renderers = self::$defaultModelRenderers;
    }

    /**
     * Allow model to be rendered directly
     *
     * @return \Illuminate\View\View
     */
    public function __toString()
    {
        return View::make($this->renderers[$this->mode], [
            'entity' => $this->entity
        ]);
    }

    /**
     * Allow for property-style retrieval
     *
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if(method_exists($this, $property))
            return $this->{$property}();

        return $this->render($property);
    }

    /**
     * Allow for method-style retrieval
     *
     * @param $property
     * @param $args
     * @throws RendererException
     */
    public function __call($property, $args)
    {
        return $this->render($property);
    }

    /**
     * @param $property
     * @param null $renderer
     * @param array $options
     */
    protected function render($property, $renderer = null, $options = [])
    {
        $propertyRenderers = self::$defaultPropertyRenderers;

        // Load default renderer if no renderer defined
        if(is_null($renderer))
            $renderer = $propertyRenderers[$this->mode];

        // If the $renderer is a valid class instanciate and run
        if(class_exists($renderer)) {
            $renderer = new $renderer($this->entity, $property, $this->mode);
            return $renderer;
        }

        // If $renderer is a view, compile and return the view
        elseif(View::exists($renderer)) {
            return View::make($renderer, [
                'entity' => $this->entity,
                'property' => $property,
                'value' => $this->entity->$property
            ]);
        }
        else {
            throw new RendererException('Could not found any class or view named "' . $renderer . '" for rendering property "' . $property . '" of object "' . get_class($this->entity) . '"');
        }
    }
} 
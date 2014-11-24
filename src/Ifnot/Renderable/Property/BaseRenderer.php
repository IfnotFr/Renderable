<?php namespace Ifnot\Renderable\Property;

/**
 * Class BaseRenderer
 * @package Ifnot\Renderable\Property
 */
abstract class BaseRenderer {

    protected $entity;
    protected $property;
    protected $mode;
    protected $bind;

	protected $options = [
		'views' => [
            'show' => 'ifnot.renderable::renderer.property.html'
        ]
	];

    /**
     * @param $entity
     * @param $property
     */
    public function __construct($entity, $property, $mode, $bind = [])
    {
        $this->entity = $entity;
        $this->property = $property;
        $this->mode = $mode;
        $this->bind = $bind;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->entity->{$this->property};
    }

    /**
     * @param $content
     */
    public function set($content)
	{
        $this->entity->{$this->property} = $content;
        $this->entity->save();
	}

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !isset($this->entity->{$this->property}) OR empty($this->entity->{$this->property});
    }

    /**
     * @return string
     */
    public function __toString()
	{
        return \View::make($this->options['views'][$this->mode], array_merge([
            'entity' => $this->entity,
            'property' => $this->property,
            'value' => $this->get(),
            'options' => $this->bind
        ], $this->bind))->__toString();
	}
}
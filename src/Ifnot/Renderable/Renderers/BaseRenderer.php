<?php namespace Ifnot\Renderable\Renderers;

/**
 * Class BaseRenderer
 * @package Ifnot\Renderable\Renderers
 */
class BaseRenderer {

    protected $entity;
    protected $attribute;

	protected $options = [
		'view' => 'ifnot.renderable::renderer.attribute.html'
	];

    public function __construct($entity, $attribute, $options)
    {
        $this->entity = $entity;
        $this->attribute = $attribute;
    }

    public function get()
    {
        $attribute = $this->attribute;
        return $this->entity->$attribute;
    }

	public function set($content)
	{
        $attribute = $this->attribute;

        $this->entity->$attribute = $content;
        $this->entity->save();
	}

    public function isEmpty()
    {
        $attribute = $this->attribute;

        return !isset($this->entity->$attribute) OR empty($this->entity->$attribute);
    }

	public function __toString()
	{
		return $this->get();
	}
}
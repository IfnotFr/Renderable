<?php namespace Ifnot\Renderable\Renderers\Property;

/**
 * Class BaseRenderer
 * @package Ifnot\Renderable\Renderers\Property
 */
abstract class BaseRenderer {

    protected $entity;
    protected $attribute;

	protected $options = [
		'view' => [
            'show' => 'ifnot.renderable::renderer.attribute.html'
        ]
	];

    /**
     * @param $entity
     * @param $attribute
     * @param $options
     */
    public function __construct($entity, $attribute, $options)
    {
        $this->entity = $entity;
        $this->attribute = $attribute;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->entity->{$this->attribute};
    }

    /**
     * @param $content
     */
    public function set($content)
	{
        $this->entity->{$this->attribute} = $content;
        $this->entity->save();
	}

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !isset($this->entity->{$this->attribute}) OR empty($this->entity->{$this->attribute});
    }

    /**
     * @param $tag
     * @param $attributes
     * @return string
     */
    public function into($tag, $attributes)
    {
        $openTag = '<' . $tag . ' ';
        foreach($attributes as $name => $value) {
            $openTag .= $name . '="' . str_replace('"', '\\"', $value) . '" ';
        }
        $openTag .= '>';

        $closeTag = '</' . $tag . '>';

        return $openTag . (string) $this->get() . $closeTag;
    }

    /**
     * @return string
     */
    public function __toString()
	{
		return (string) $this->get();
	}
}
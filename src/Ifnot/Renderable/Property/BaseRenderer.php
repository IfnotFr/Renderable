<?php namespace Ifnot\Renderable\Property;

/**
 * Class BaseRenderer
 * @package Ifnot\Renderable\Property
 */
abstract class BaseRenderer {

    protected $entity;
    protected $property;

    public static $defaultRenderers;

	protected $options = [
		'view' => [
            'show' => 'ifnot.renderable::renderer.property.html'
        ]
	];

    /**
     * @param $entity
     * @param $property
     * @param $options
     */
    public function __construct($entity, $property, $options)
    {
        $this->entity = $entity;
        $this->property = $property;
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
     * @param $tag
     * @param $propertys
     * @return string
     */
    public function into($tag, $propertys)
    {
        $openTag = '<' . $tag . ' ';
        foreach($propertys as $name => $value) {
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
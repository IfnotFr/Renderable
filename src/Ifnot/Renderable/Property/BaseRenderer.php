<?php namespace Ifnot\Renderable\Renderers\Property;

/**
 * Class BaseRenderer
 * @package Ifnot\Renderable\Renderers\Property
 */
abstract BaseRenderer {

    protected $entity;
    protected $attribute;

	protected $options = [
		'view' => [
            'show' => 'ifnot.renderable::renderer.attribute.html'
        ]
	];

    public function __construct($entity, $attribute, $options)
    {
        $this->entity = $entity;
        $this->attribute = $attribute;
    }

    public function get()
    {
        return $this->entity->{$this->attribute};
    }

	public function set($content)
	{
        $this->entity->{$this->attribute} = $content;
        $this->entity->save();
	}

    public function isEmpty()
    {
        return !isset($this->entity->{$this->attribute}) OR empty($this->entity->{$this->attribute});
    }

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

	public function __toString()
	{
		return (string) $this->get();
	}
}
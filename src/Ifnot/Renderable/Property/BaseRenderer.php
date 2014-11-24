<?php namespace Ifnot\Renderable\Property;

/**
 * Class BaseRenderer
 * @package Ifnot\Renderable\Property
 */
abstract class BaseRenderer {

    protected $entity;
    protected $property;
    protected $mode;

	protected $options = [
		'views' => [
            'show' => 'ifnot.renderable::renderer.property.html'
        ]
	];

    /**
     * @param $entity
     * @param $property
     * @param $options
     */
    public function __construct($entity, $property, $mode)
    {
        $this->entity = $entity;
        $this->property = $property;
        $this->mode = $mode;
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

        return $openTag . (string) $this->render() . $closeTag;
    }

    /**
     * @return string
     */
    protected function render($options = [])
    {
        return \View::make($this->options['views'][$this->mode], [
            'entity' => $this->entity,
            'property' => $this->property,
            'value' => $this->entity->{$this->property},
            'options' => $options
        ])->__toString();
    }

    /**
     * @return string
     */
    public function __toString()
	{
        return $this->render();
	}
}
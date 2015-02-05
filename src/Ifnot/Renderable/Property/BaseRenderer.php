<?php namespace Ifnot\Renderable\Property;

/**
 * Class BaseRenderer
 * @package Ifnot\Renderable\Property
 */
abstract class BaseRenderer {
    protected $value;
    protected $mode;
    protected $bind;

	protected $views = [
		'show' => 'ifnot.renderable::renderer.property.html'
	];

    /**
     * @param       $value
     * @param       $mode
     * @param array $bind
     *
     * @internal param $entity
     * @internal param $property
     */
    public function __construct($value, $mode, $bind)
    {
        $this->value = $value;
        $this->mode = $mode;
        $this->bind = $bind;
    }

    /**
     * @return string
     */
    public function __toString()
	{
        return \View::make($this->views[$this->mode], array_merge([
            'value' => $this->value,
            'bind' => $this->bind
        ], $this->bind))->__toString();
	}
}
<?php namespace Ifnot\Renderable\Traits;

use Ifnot\Renderable\Exceptions\RendererException;

/**
 * Class ModelRendererTrait
 * @package Ifnot\Renderable\Traits
 */
trait ModelRendererTrait {

    protected $bind = [];

	/**
     * @return string
     */
    public function __toString()
    {
        return $this->renderModel();
    }

	/**
     * @param $bind
     */
    public function bind($bind)
    {
        $this->bind = $bind;

        return $this;
    }

	/**
     * @return string
     */
    protected function renderModel()
    {
        $this->testRenderableConfiguration('model');

        return (string) \View::make($this->renderable['model'][$this->mode], array_merge([
            'entity' => $this->getEntity(),
            $this->getEntityBaseName() => $this->getEntity()
        ], $this->bind))->render();
    }

    /**
     * @return string
     */
    protected function getEntityBaseName()
    {
        return strtolower(class_basename(get_class($this->getEntity())));
    }
} 
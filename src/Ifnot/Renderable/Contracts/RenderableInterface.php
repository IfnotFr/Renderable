<?php namespace Ifnot\Renderable\Contracts;

/**
 * Interface RenderableInterface
 * @package Ifnot\Renderable\Contracts
 */
interface RenderableInterface {
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param $content
     * @return mixed
     */
    public function set($content);

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @return mixed
     */
    public function __toString();
} 
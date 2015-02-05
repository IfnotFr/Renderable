<?php namespace Ifnot\Renderable\Traits;

use Ifnot\Renderable\Exceptions\RendererException;

/**
 * Class PropertyRendererTrait
 * @package Ifnot\Renderable
 */
trait PropertyRendererTrait {

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

		return $this->render($this->getEntity()->$property);
	}

	/**
	 * @param       $value
	 * @param null  $classOrView
	 * @param array $bind
	 */
	public function render($value, $classOrView = null, $bind = [])
	{
		$this->testRenderableConfiguration('property');

		// Get property name
		list(,$caller) = debug_backtrace(false, 5);
		if($caller['function'] == "__get") $property = $caller['args'][0];
		else $property = $caller['function'];

		// Load default renderer if no renderer defined
		if(is_null($classOrView))
			$classOrView = $this->renderable['property'][$this->mode];

		// If the $renderer is a valid class instanciate and run
		if(class_exists($classOrView)) {
			return new $classOrView($value, $this->mode, $bind);
		}

		// If $renderer is a view, compile and return the view
		elseif(\View::exists($classOrView)) {
			return \View::make($classOrView, array_merge([
				'property' => $value,
			], $this->bind, $bind))->render();
		}
		else {
			throw new RendererException('Could not found any class or view named "' . $classOrView . '" for rendering property "' . $property . '" of object "' . get_class($this->entity) . '"');
		}
	}
} 
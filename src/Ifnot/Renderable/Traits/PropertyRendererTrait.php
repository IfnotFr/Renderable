<?php namespace Ifnot\Renderable\Traits;

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

		return $this->renderProperty($property);
	}

	/**
	 * @param null  $classOrView
	 * @param array $bind
	 *
	 * @return string
	 */
	public function render($classOrView = null, $bind = [])
	{
		// Get property name
		list(,$caller) = debug_backtrace(false, 2);
		$property = $caller['function'];

		return $this->renderProperty($property, $classOrView, $bind);
	}

	/**
	 * @param       $property
	 * @param null  $classOrView
	 * @param array $bind
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function renderProperty($property, $classOrView = null, $bind = [])
	{
		// Save that we render a property of an object
		$bind['render'] = [
			'entity' => $this->entity,
			'property' => $property
		];

		return $this->renderValue($this->entity->$property, $classOrView, $bind);
	}

	/**
	 * @param       $value
	 * @param null  $classOrView
	 * @param array $bind
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function renderValue($value, $classOrView = null, $bind = [])
	{
		if(is_null($classOrView))
			$classOrView = $this->getRenderable('property');

		// If the $renderer is a valid class instanciate and run
		if(class_exists($classOrView)) {
			return new $classOrView($value, $this->mode, $bind);
		}

		// If $renderer is a view, compile and return the view
		elseif(\View::exists($classOrView)) {
			return \View::make($classOrView, array_merge([
				'value' => $value,
			], $bind))->render();
		}
		else {
			throw new \Exception('Could not found any class or view named "' . $classOrView . '" for rendering property of object "' . get_class($this->entity) . '"');
		}
	}
} 

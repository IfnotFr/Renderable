# Renderable

Renderable is a PHP Presenter for Laravel, based on blade views for a final presentation of Eloquent models directly on your views.

## Installation

Simply install the package with composer.

```bash
composer require ifnot/renderable
```

Register the package service provider into your `app.php` :

```php
'Ifnot\Renderable\RenderableServiceProvider',
```

## How it works ?

A Renderable object is like a Presenter object but for returning views (complete or partial). If you are familiar with the Presenter pattern, you should understand easily Renderable mechanisms.

The main goal of this package is to provide witch view to use for rendering a model/property. This is very usefull if you want to include an model (or model property) in your view direcly without specifying the html witch definy him.

There are two aspects in this package :
  * Property renderer
  * Model renderer

## Basic setup for Property Renderer

We have a `Page` Model (it could be Eloquent Model) and a `PageRenderer` (the Renderer class assigned for Page).

Page :
```php
use Ifnot\Renderable\RenderableTrait;

class Page extends Eloquent {
  use RenderableTrait;
  public $renderer = 'PageRenderer';
}
```

PageRenderer :
```php
use Ifnot\Renderable\Renderer;

class PageRenderer extends Renderer {
	public function title() {
		return $this->render($this->entity->title, 'page.property.title');
	}
}
```

And then, the `page.property.title` view:
```html
<h1>{{ $property }}</h1>
```

Now you can call `$page->render()->title` into a regular view of your app:

```html
  .. other stuff here ...
  
  <div>
    {{ $page->render()->title}}
    
    <p>This is another text, blah blah blah ...</p>
  </div>
  
  .. other stuff here ..
```

### Basic setup for Model Renderer

Now ok, you want to render your whole model by itself, without specifying each properties. We have to add some configuration into `PageRenderer` :

PageRenderer :
```php
use Ifnot\Renderable\Renderer;

class PageRenderer extends Renderer {
  public $renderable = [
		'model' => [
			'show' => 'page.model'
		]
	];
  
  // ...
	// Here, properties declaration (like title in the previous example)
	// ...
}
```

And then, the `page.model` view :
```html
<div>
  <h1>{{ $entity->render()->title }}</h1>
  
  <p>{{ $entity->content }}</p>
</div>
```

Now you can call `$page->render()` into a view :

```html
  .. other stuff here ..
  
  <article>
    {{ $page->render() }}
  </article>
  
  .. other stuff here ..
```

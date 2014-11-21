<?php

return [
    //
    // Renderers configuration
    //
    // Configure here witch renderers do you want to use by default. You can also
    // change renderers on your model implementation directly.
    //

    'default_model_renderers' => [
        'show' => 'ifnot.renderable::renderer.model.html'
    ],
    'default_property_renderers' => [
        'show' => 'ifnot.renderable::renderer.property.html'
    ],

    //
    // Rendering Mode
    //
    // Same as before, this is the default rendering mode.
    //
    'default_rendering_mode' => 'show'
];
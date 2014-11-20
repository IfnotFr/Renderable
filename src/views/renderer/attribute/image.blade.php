<img
    src="{{ asset('six/img/source/' . $block->source) }}"
    {{ isset($block->alt) ? 'alt="' . $block->alt . '"' : '' }}
    class="{{ isset($block->responsive) ? 'img-responsive' : '' }} {{ isset($block->shape) ? 'img-' . $block->shape : '' }}"
    style="
        {{ isset($block->width) ? 'max-width: ' . $block->width . 'px;' : '' }}
        {{ isset($block->height) ? 'max-height: ' . $block->height . 'px;' : '' }}"
/>
@props([
    'image' => null,
    'alt' => '',
    'class' => '',
    'eager' => false,
])

@if ($image)
    <picture>
        <source
            type="image/webp"
            srcset="{{ $image->thumb(['width' => 320, 'format' => 'webp'])->url() }} 320w,
                    {{ $image->thumb(['width' => 640, 'format' => 'webp'])->url() }} 640w,
                    {{ $image->thumb(['width' => 768, 'format' => 'webp'])->url() }} 768w,
                    {{ $image->thumb(['width' => 1024, 'format' => 'webp'])->url() }} 1024w,
                    {{ $image->thumb(['width' => 1280, 'format' => 'webp'])->url() }} 1280w,
                    {{ $image->thumb(['width' => 1536, 'format' => 'webp'])->url() }} 1536w"
            sizes="100vw"
        >
        <source
            type="image/jpeg"
            srcset="{{ $image->thumb(['width' => 320, 'format' => 'jpg'])->url() }} 320w,
                    {{ $image->thumb(['width' => 640, 'format' => 'jpg'])->url() }} 640w,
                    {{ $image->thumb(['width' => 768, 'format' => 'jpg'])->url() }} 768w,
                    {{ $image->thumb(['width' => 1024, 'format' => 'jpg'])->url() }} 1024w,
                    {{ $image->thumb(['width' => 1280, 'format' => 'jpg'])->url() }} 1280w,
                    {{ $image->thumb(['width' => 1536, 'format' => 'jpg'])->url() }} 1536w"
            sizes="100vw"
        >
        <img
            src="{{ $image->thumb(['width' => 1024, 'format' => 'jpg'])->url() }}"
            alt="{{ $alt ?: ($image->alt()->isNotEmpty() ? $image->alt() : '') }}"
            class="{{ $class }}"
            width="{{ $image->width() }}"
            height="{{ $image->height() }}"
            loading="{{ $eager ? 'eager' : 'lazy' }}"
            {{ $eager ? 'fetchpriority=high' : '' }}
        >
    </picture>
@endif

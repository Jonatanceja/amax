@props([
    'block' => null,
])

@if ($block)
    <div class="gsap-fade max-w-4xl mx-auto mt-16 text-center flex flex-col justify-center">
        <h2 class="text-5xl font-bold mb-4 text-gray-800 dark:text-white">{{ $block->headline() }}</h2>
        <div class="text-gray-600 dark:text-gray-400 prose dark:prose-invert mx-auto">{!! $block->text()->kt() !!}</div>
    </div>
@endif

@php
    /**
     * @var Kirby\Cms\App $kirby
     * @var Kirby\Cms\Page $page
     * @var Kirby\Cms\Site $site
     */
@endphp

<x-layout>
    <section class="relative h-[33vh] md:h-[50vh]">
        @if ($image = $page->cover()->toFile())
            <x-ui.picture :image="$image" alt="{{ $page->title() }}" class="w-full h-full object-cover z-0" :eager="true" />
            <div class="absolute inset-0 z-10 bg-black/50 flex items-center justify-center">
            <h1 class="text-white text-4xl md:text-5xl lg:text-8xl font-bold text-center px-4 max-w-5xl mt-20">{{ $page->title() }}</h1>
            </div>
        @endif
    </section>
    <div class="min-h-screen px-6 z-20 relative mb-16">
        @foreach ($page->page_builder()->toBlocks() as $block)
            @if ($block->type() === 'paragraph')
                <x-ui.paragraph :block="$block" />
            @elseif ($block->type() === 'before_after')
                <x-ui.beforeafter :block="$block" :loop="$loop" />
            @elseif ($block->type() === 'blurbs')
                <div class="h-16"></div>
                <x-ui.blurbs :block="$block" />
            @elseif ($block->type() === 'cta')
                <x-ui.cta :block="$block" />
            @endif

        @endforeach
    </div>
</x-layout>
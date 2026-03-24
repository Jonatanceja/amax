@php
    /**
     * @var Kirby\Cms\App $kirby
     * @var Kirby\Cms\Page $page
     * @var Kirby\Cms\Site $site
     */
@endphp

<x-layout>
    <x-ui.hero
        :image="$page->hero_image()->toFile()"
        :title="$page->hero_title()->value()"
        :subtitle="$page->hero_subtitle()->value()"
    />
    <div class="min-h-screen pt-16 pb-20 px-6 z-20 relative">
        @foreach ($page->page_builder()->toBlocks() as $block)
            @if ($block->type() === 'blurbs')
                <x-ui.blurbs :block="$block" />
            @elseif ($block->type() === 'paragraph')
                <x-ui.paragraph :block="$block" />
            @elseif ($block->type() === 'zigzag')
            <div class="relative max-w-6xl mx-auto">
                <x-ui.zigzag :block="$block" :loop="$loop" />
            </div>
            @elseif ($block->type() === 'latest_projects')
                <x-ui.latest-projects :block="$block" />
            @elseif ($block->type() === 'cta')
                <x-ui.cta :block="$block" />
            @elseif ($block->type() === 'testimonials')
                <x-ui.testimonials :block="$block" />
            @endif

        @endforeach
    </div>
    
</x-layout>
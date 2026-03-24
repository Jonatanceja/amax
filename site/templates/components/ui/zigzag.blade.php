@props([
    'block' => null,
    'loop' => null,
])

@if ($block)
    @php
        $reverse = $loop && $loop->odd;
    @endphp
    <div class="gsap-fade max-w-6xl mx-auto mt-16 flex flex-col {{ $reverse ? 'md:flex-row-reverse' : 'md:flex-row' }} items-center gap-12">
        <div class="w-full md:w-1/2">
            <h2 class="text-5xl font-bold mb-4 text-gray-800 dark:text-white">{{ $block->headline() }}</h2>
            <div class="text-gray-600 dark:text-gray-400 prose dark:prose-invert prose-blockquote:border-red-600">{!! $block->text()->kt() !!}</div>
            @if ($block->button_text()->isNotEmpty())
                <a href="{{ $block->button_url()->toUrl() }}" class="inline-block mt-6 bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3 rounded-full transition duration-200">
                    {{ $block->button_text() }}
                </a>
            @endif
        </div>
        <div class="w-full md:w-1/2">
            @if ($img = $block->image()->toFile())
                <x-ui.picture :image="$img" alt="{{ $img->alt() ?? $block->headline() }}" class="w-full rounded-lg shadow-lg" />
            @endif
        </div>
    </div>
@endif

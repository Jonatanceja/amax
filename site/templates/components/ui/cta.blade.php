@props([
    'block' => null,
])

@if ($block)
    <div class="gsap-fade max-w-6xl mx-auto mt-16 text-center p-12 bg-gray-900 dark:bg-red-600 rounded-lg md:flex items-end justify-between">
        <div class="w-full md:w-2/3 text-center md:text-left">
            <h2 class="text-3xl md:text-5xl font-bold mb-4 text-white">{{ $block->headline() }}</h2>
            @if ($block->text()->isNotEmpty())
                <p class="text-white/80 text-lg font-semibold">{{ $block->text() }}</p>
            @endif
        </div>
        <div class="w-full md:w-1/3 text-center md:text-left flex justify-center md:justify-end mt-5 md:mt-0">

            @foreach ($block->button()->toStructure() as $button)
                <a href="{{ $button->link()->toUrl() }}" class="inline-block bg-white text-gray-900 dark:text-red-600 font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition duration-200">
                    {{ $button->text() }}
                </a>
            @endforeach
        </div>
    </div>
@endif

@props([
    'block' => null,
])

@if ($block)
    <div class="gsap-fade max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-16">
        @foreach ($block->values()->toStructure() as $value)
            <div class="flex flex-col items-start text-left justify-start p-6 bg-white/50 dark:bg-gray-700/50 border border-white dark:border-gray-600 backdrop-blur-sm dark:shadow-gray-950 shadow-2xl rounded-lg transform hover:scale-105 transition duration-300">
                @if ($icon = $value->icon()->toFile())
                    <img src="{{ $icon->url() }}" alt="{{ $value->headline() }}" class="w-16 h-16 mb-4 bg-red-600 rounded-lg p-2">
                @endif
                <span class="text-xl font-bold mb-2 text-gray-800 dark:text-white w-full">{{ $value->headline() }}</span>
                <p class="text-gray-600 dark:text-gray-400">{{ $value->description() }}</p>
            </div>
        @endforeach
    </div>
@endif
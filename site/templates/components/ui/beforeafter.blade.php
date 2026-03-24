@props([
    'block' => null,
    'loop' => null,
])

@if ($block)
    @php
        $reverse = $loop && $loop->odd;
        $before = $block->before()->toFile();
        $after = $block->after()->toFile();
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
            @if ($before && $after)
                <div
                    class="relative overflow-hidden rounded-lg shadow-lg select-none"
                    role="slider"
                    aria-label="Before and after comparison. Drag to adjust."
                    :aria-valuenow="Math.round(position)"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    tabindex="0"
                    x-cloak
                    x-data="{ position: 50, dragging: false }"
                    x-on:mousedown="dragging = true"
                    x-on:mouseup.window="dragging = false"
                    x-on:mousemove.window="if (dragging) { const rect = $el.getBoundingClientRect(); position = Math.min(100, Math.max(0, ((event.clientX - rect.left) / rect.width) * 100)) }"
                    x-on:touchmove="const rect = $el.getBoundingClientRect(); position = Math.min(100, Math.max(0, (($event.touches[0].clientX - rect.left) / rect.width) * 100))"
                    x-on:keydown.left.prevent="position = Math.max(0, position - 5)"
                    x-on:keydown.right.prevent="position = Math.min(100, position + 5)"
                >
                    {{-- After image (full, behind) --}}
                    <x-ui.picture :image="$after" alt="{{ $after->alt() ?? 'After' }}" class="w-full aspect-[4/3] object-cover block" />

                    {{-- Before image (clipped) --}}
                    <div class="absolute inset-0" :style="'clip-path: inset(0 ' + (100 - position) + '% 0 0)'">
                        <x-ui.picture :image="$before" alt="{{ $before->alt() ?? 'Before' }}" class="w-full h-full object-cover block" />
                    </div>

                    {{-- Slider handle --}}
                    <div class="absolute top-0 bottom-0 w-1 bg-white cursor-ew-resize" :style="'left: ' + position + '%'" style="transform: translateX(-50%)">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l-3 3 3 3m8-6l3 3-3 3" />
                            </svg>
                        </div>
                    </div>

                    {{-- Labels --}}
                    <span class="absolute top-3 left-3 text-xs font-bold text-white bg-black/50 px-2 py-1 rounded">Before</span>
                    <span class="absolute top-3 right-3 text-xs font-bold text-white bg-black/50 px-2 py-1 rounded">After</span>
                </div>
            @endif
        </div>
    </div>
@endif

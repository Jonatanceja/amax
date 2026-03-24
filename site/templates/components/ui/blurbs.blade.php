@props([
    'block' => null,
])

@if ($block)
    @php
        $projectsPage = site()->find('projects');
        $projectsUrl  = $projectsPage ? $projectsPage->url() : '/projects';
    @endphp

    <div class="gsap-fade max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($block->blurbs()->toStructure() as $blurb)
            @php
                $tagSlug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($blurb->tag())));
            @endphp
            <div class="flex flex-col bg-white/50 dark:bg-gray-700/50 border border-white dark:border-gray-600 backdrop-blur-sm shadow-2xl dark:shadow-gray-950 rounded-xl overflow-hidden hover:scale-105 transition duration-300">

                {{-- Photo mode: full-width image at top --}}
                @if ($blurb->display()->value() === 'image' && ($img = $blurb->image()->toFile()))
                    <div class="w-full aspect-video overflow-hidden shrink-0">
                        <x-ui.picture :image="$img" alt="{{ $blurb->headline() }}" class="w-full h-full object-cover" />
                    </div>
                @endif

                {{-- Content --}}
                <div class="flex flex-col flex-1 p-5">

                {{-- Icon mode: small icon inside content area --}}
                @if ($blurb->display()->value() !== 'image' && ($icon = $blurb->icon()->toFile()))
                    <img src="{{ $icon->url() }}" alt="" class="w-14 h-14 mb-4 bg-red-600 rounded-lg p-2 object-contain" aria-hidden="true">
                @endif
                    <span class="text-lg font-bold mb-2 text-gray-800 dark:text-white">{{ $blurb->headline() }}</span>
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex-1">{{ $blurb->description() }}</p>

                    @if ($blurb->button_text()->isNotEmpty() && $blurb->tag()->isNotEmpty())
                        <a
                            href="{{ $projectsUrl }}#tag-{{ $tagSlug }}"
                            class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-red-600 hover:text-red-700 transition duration-200"
                        >
                            {{ $blurb->button_text() }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        @endforeach

        @if ($block->button_text()->isNotEmpty())
            <div class="flex flex-col items-center justify-center p-6 bg-red-600 hover:bg-red-700 rounded-xl transition duration-300">
                <a href="{{ $block->button_url()->toUrl() }}" class="text-white text-xl font-bold flex items-center gap-2">
                    {{ $block->button_text() }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        @endif
    </div>
@endif

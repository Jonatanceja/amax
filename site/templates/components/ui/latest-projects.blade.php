@props([
    'block' => null,
])

@if ($block)
    @php
        $projectsPage = site()->find('projects');
        $projects = collect([]);

        if ($projectsPage) {
            foreach ($projectsPage->page_builder()->toBlocks() as $b) {
                if ($b->type() === 'projects') {
                    $projects = $b->projects()->toStructure();
                    break;
                }
            }
        }

        $latest = $projects->slice(0, 12);
    @endphp

    @if ($latest->count())
        <div class="gsap-fade max-w-6xl mx-auto mt-16 mb-8">
            @if ($block->headline()->isNotEmpty())
                <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 dark:text-white mb-10">
                    {{ $block->headline() }}
                </h2>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                @foreach ($latest as $project)
                    @if ($img = $project->image()->toFile())
                        <a href="{{ $img->thumb(['width' => 1536, 'format' => 'webp'])->url() }}" data-fancybox data-caption="{{ $project->caption() }}" class="group relative overflow-hidden rounded-lg">
                            <x-ui.picture :image="$img" alt="{{ $project->caption() }}" class="w-full aspect-3/2 object-cover" />
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition duration-300 flex items-end">
                                <div class="p-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                                    @if ($project->caption()->isNotEmpty())
                                        <p class="text-white font-bold text-sm">{{ $project->caption() }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>

            @if ($block->button_text()->isNotEmpty())
                <div class="text-center mt-10">
                    <a href="{{ $block->button_url()->toUrl() }}" class="inline-flex items-center gap-2 px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition duration-300">
                        {{ $block->button_text() }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    @endif
@endif

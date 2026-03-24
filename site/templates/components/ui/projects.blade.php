@props([
    'block' => null,
])

@if ($block)
    @php
        $projects = $block->projects()->toStructure()->flip();
        $allTags = [];
        foreach ($projects as $project) {
            foreach ($project->tags()->split(',') as $tag) {
                $tag = trim($tag);
                if ($tag && !in_array($tag, $allTags)) $allTags[] = $tag;
            }
        }
        sort($allTags);
    @endphp

    <div class="gsap-fade max-w-6xl mx-auto mt-16"
        x-data="{
            activeTag: 'all',
            currentPage: 1,
            perPage: 24,
            totalPages: 1,
            visibleIds: new Set(),
            slugify(tag) {
                return tag.toLowerCase().replace(/[^a-z0-9]+/g, '-');
            },
            init() {
                // Read hash on load and activate matching tag
                const hash = window.location.hash;
                if (hash.startsWith('#tag-')) {
                    const slug = hash.slice(5);
                    const btn = this.$el.querySelector(`[data-tag-slug='${slug}']`);
                    if (btn) this.activeTag = btn.dataset.tag;
                }
                this.updateVisible();
                this.$watch('activeTag', () => {
                    this.currentPage = 1;
                    this.updateVisible();
                    // Update URL hash
                    if (this.activeTag === 'all') {
                        history.replaceState(null, '', window.location.pathname);
                    } else {
                        history.replaceState(null, '', '#tag-' + this.slugify(this.activeTag));
                    }
                });
                this.$watch('currentPage', () => {
                    this.updateVisible();
                    this.$el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            },
            updateVisible() {
                const all = [...this.$el.querySelectorAll('[data-project]')];
                const filtered = all.filter(el =>
                    this.activeTag === 'all' || JSON.parse(el.dataset.tags || '[]').includes(this.activeTag)
                );
                this.totalPages = Math.max(1, Math.ceil(filtered.length / this.perPage));
                const start = (this.currentPage - 1) * this.perPage;
                this.visibleIds = new Set(filtered.slice(start, start + this.perPage).map(el => el.dataset.idx));
            },
        }"
        x-cloak>

        {{-- Filter buttons --}}
        <div class="flex flex-wrap gap-3 mb-8 justify-center" role="group" aria-label="Filter projects by category">
            <button
                @click="activeTag = 'all'"
                :aria-pressed="(activeTag === 'all').toString()"
                :class="activeTag === 'all' ? 'bg-red-600 text-white' : 'bg-white/50 hover:bg-white/10 dark:bg-gray-700/50 text-gray-800 dark:text-white border border-white dark:border-gray-600'"
                class="px-5 py-2 rounded-full font-medium transition duration-200 backdrop-blur-sm cursor-pointer"
            >All</button>

            @foreach ($allTags as $tag)
                @php $tagSlug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($tag))); @endphp
                <button
                    @click="activeTag = '{{ $tag }}'"
                    data-tag="{{ $tag }}"
                    data-tag-slug="{{ $tagSlug }}"
                    :aria-pressed="(activeTag === '{{ $tag }}').toString()"
                    :class="activeTag === '{{ $tag }}' ? 'bg-red-600 text-white' : 'bg-white/50 hover:bg-white/10 dark:bg-gray-700/50 text-gray-800 dark:text-white border border-white dark:border-gray-600'"
                    class="px-5 py-2 rounded-full font-medium transition duration-200 backdrop-blur-sm cursor-pointer"
                >{{ $tag }}</button>
            @endforeach
        </div>

        {{-- Gallery grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($projects as $i => $project)
                @php
                    $projectTags = array_values(array_map('trim', $project->tags()->split(',')));
                    $tagsJson = json_encode($projectTags);
                @endphp
                <div
                    data-project
                    data-idx="{{ $i }}"
                    data-tags="{{ $tagsJson }}"
                    x-show="visibleIds.has('{{ $i }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="group relative overflow-hidden rounded-lg"
                >
                    @if ($img = $project->image()->toFile())
                        <a href="{{ $img->thumb(['width' => 1536, 'format' => 'webp'])->url() }}" data-fancybox data-caption="{{ $project->caption() }}">
                            <x-ui.picture :image="$img" alt="{{ $project->caption() }}" class="w-full aspect-3/2 object-cover" />
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition duration-300 flex items-end">
                                <div class="p-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                                    @if ($project->caption()->isNotEmpty())
                                        <p class="text-white font-bold text-sm">{{ $project->caption() }}</p>
                                    @endif
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach ($projectTags as $tag)
                                            @if ($tag)
                                                <span class="text-xs text-white/70">{{ $tag }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div x-show="totalPages > 1" class="flex items-center justify-center gap-4 mt-12">
            <button
                @click="currentPage--"
                :disabled="currentPage <= 1"
                :class="currentPage <= 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-red-700 cursor-pointer'"
                class="bg-red-600 text-white px-6 py-2.5 rounded-full font-medium transition duration-200"
            >← Prev</button>

            <span class="text-gray-600 dark:text-gray-300 font-medium tabular-nums"
                x-text="`${currentPage} / ${totalPages}`"></span>

            <button
                @click="currentPage++"
                :disabled="currentPage >= totalPages"
                :class="currentPage >= totalPages ? 'opacity-40 cursor-not-allowed' : 'hover:bg-red-700 cursor-pointer'"
                class="bg-red-600 text-white px-6 py-2.5 rounded-full font-medium transition duration-200"
            >Next →</button>
        </div>

    </div>
@endif

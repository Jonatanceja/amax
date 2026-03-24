@props([
    'image'    => null,
    'title'    => '',
    'subtitle' => '',
])

<section id="hero" class="relative h-screen w-full overflow-hidden z-20" aria-label="Hero">

    {{-- Background image --}}
    @if ($image)
        <div id="hero-image" class="absolute inset-0 scale-110 origin-center">
            <x-ui.picture :image="$image" alt="{{ $title }}" class="w-full h-full object-cover" :eager="true" />
        </div>
    @endif

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/50 z-10"></div>

    {{-- Content --}}
    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center px-6 text-center">
        @if ($title)
            <h1 id="hero-title"
                class="text-white text-4xl md:text-7xl font-bold max-w-5xl"
                aria-label="{{ $title }}">
                {{ $title }}
            </h1>
        @endif

        @if ($subtitle)
            <p id="hero-subtitle" class="text-white/80 text-lg md:text-2xl mt-6 max-w-2xl opacity-0">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Decorative line --}}
        <div id="hero-line" class="mt-10 w-0 h-px bg-white/50"></div>
    </div>

    {{-- Scroll indicator --}}
    <div id="hero-scroll-indicator" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-50 flex flex-col items-center gap-2 text-white/0">
        <span class="text-xs uppercase tracking-widest font-medium">Scroll</span>
        <div class="w-6 h-10 rounded-full border-2 border-white/60 flex items-start justify-center p-1">
            <div id="hero-scroll-dot" class="w-1.5 h-1.5 rounded-full bg-white"></div>
        </div>
    </div>

</section>

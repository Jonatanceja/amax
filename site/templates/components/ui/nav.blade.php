@php
    $site = site();
@endphp

{{-- resources/views/components/navbar.blade.php --}}

@props([
    'phone' => '212 3123 123',
    'phonelink' => '#',
    'ctaText' => 'Contact Us',
    'ctaUrl' => '#',
    'quoteText' => 'Get a free quote'
])

@php
    // Obtener site de forma segura (compatible con Kirby)
    $siteObj = $site ?? (function_exists('site') ? site() : null);

    // Obtener navegación (excluir contact)
    $navItems = $siteObj ? $siteObj->children()->listed()->filter(fn ($p) => $p->intendedTemplate()->name() !== 'contact') : collect([]);
@endphp

<!-- Navbar Flotante -->
<nav x-data="{ open: false, scrolled: window.scrollY > 50 }" x-init="scrolled = window.scrollY > 50" @scroll.window="scrolled = (window.scrollY > 50)" aria-label="Main navigation" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-[95%] max-w-6xl">
    <div class="bg-white/70 dark:bg-gray-700/50 backdrop-blur-sm border border-white dark:border-gray-600 rounded-full shadow-lg px-6 py-3">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="shrink-0" :style="'width:' + (window.innerWidth >= 1024 ? (scrolled ? '9rem' : '12rem') : '9rem') + '; transition: width 0.5s ease'">
                <a href="{{ $siteObj ? $siteObj->url() : '/' }}" class="flex items-center">
                    <x-svg.logo />
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                @forelse ($navItems as $subpage)
                    <a
                        href="{{ $subpage->url() }}"
                        class="text-gray-700 dark:text-gray-200 dark:hover:text-white hover:text-red-600 font-medium transition duration-200 {{ $subpage->isActive() ? 'text-red-600 dark:text-white' : '' }}"
                    >
                        {{ $subpage->title() }}
                    </a>
                @empty
                    {{-- Fallback navigation items --}}
                    <a href="/" class="text-gray-200 hover:text-red-600 font-medium transition duration-200">Home</a>
                    <a href="/about" class="text-gray-700 hover:text-red-600 font-medium transition duration-200">About</a>
                    <a href="/services" class="text-gray-700 hover:text-red-600 font-medium transition duration-200">Services</a>
                    <a href="/projects" class="text-gray-700 hover:text-red-600 font-medium transition duration-200">Projects</a>
                @endforelse
            </div>

            <!-- Theme Toggle -->
            <div x-data="themeToggle" class="hidden lg:flex">
                <button
                    @click="next()"
                    :title="'Theme: ' + mode"
                    aria-label="Toggle colour theme"
                    class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition duration-200"
                >
                    <svg x-show="mode === 'light'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 7a5 5 0 100 10A5 5 0 0012 7z"/>
                    </svg>
                    <svg x-show="mode === 'dark'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z"/>
                    </svg>
                    <svg x-show="mode === 'system'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </button>
            </div>

            <!-- Contact Button & Phone (Desktop) -->
            <div class="hidden lg:flex lg:flex-col items-end lg:gap-2">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $quoteText }} •
                    <a href="{{ $phonelink }}" aria-label="Call us at {{ $phone }}">
                        <span class="text-red-600 dark:text-red-400 font-semibold hover:underline">{{ $phone }}</span>
                    </a>
                    <span class="ml-2 text-gray-600 dark:text-gray-400">· Lic. 904934</span>
                </div>
                <a
                    href="{{ $ctaUrl }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full font-medium transition duration-200 flex items-center"
                >
                    {{ $ctaText }}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button
                @click="open = !open"
                class="lg:hidden text-gray-700 dark:text-gray-200 hover:text-red-600 focus:outline-none"
                :aria-expanded="open.toString()"
                aria-controls="mobile-menu"
                aria-label="Toggle navigation menu"
            >
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-cloak x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        id="mobile-menu"
        role="menu"
        class="lg:hidden mt-2 bg-white rounded-3xl shadow-lg overflow-hidden"
        @click.away="open = false"
    >
        <div class="px-6 py-4 space-y-3">
            @forelse ($navItems as $subpage)
                <a
                    href="{{ $subpage->url() }}"
                    class="block text-gray-700 hover:text-red-600 font-medium py-2 transition duration-200 {{ $subpage->isActive() ? 'text-red-600' : '' }}"
                    @click="open = false"
                >
                    {{ $subpage->title() }}
                </a>
            @empty
                {{-- Fallback navigation items --}}
                <a href="/" class="block text-gray-700 hover:text-red-600 font-medium py-2 transition duration-200" @click="open = false">Home</a>
                <a href="/about" class="block text-gray-700 hover:text-red-600 font-medium py-2 transition duration-200" @click="open = false">About</a>
                <a href="/services" class="block text-gray-700 hover:text-red-600 font-medium py-2 transition duration-200" @click="open = false">Services</a>
                <a href="/projects" class="block text-gray-700 hover:text-red-600 font-medium py-2 transition duration-200" @click="open = false">Projects</a>
            @endforelse

            <div class="pt-3 border-t border-gray-200">
                <div class="text-sm text-gray-600 mb-3">
                    {{ $quoteText }}<br>
                    <span class="text-red-600 font-semibold text-lg">{{ $phone }}</span>
                </div>
                <a
                    href="{{ $ctaUrl }}"
                    class="block bg-red-600 hover:bg-red-700 text-white text-center px-6 py-3 rounded-full font-medium transition duration-200"
                    @click="open = false"
                >
                    {{ $ctaText }}
                </a>
            </div>
        </div>
    </div>
</nav>

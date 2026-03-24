@php
    /**
     * @var Kirby\Cms\App $kirby
     * @var Kirby\Cms\Page $page
     * @var Kirby\Cms\Site $site
     */
@endphp

<x-layout>
    <section class="relative min-h-screen flex items-center justify-center px-6">
        <div class="text-center max-w-2xl">
            <h1 class="text-[10rem] md:text-[14rem] font-bold leading-none text-red-600">404</h1>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">Page not found</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-10">Sorry, the page you are looking for doesn't exist or has been moved.</p>
            <a href="{{ site()->url() }}" class="inline-flex items-center gap-2 px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full transition duration-300">
                Go back home
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </section>
</x-layout>

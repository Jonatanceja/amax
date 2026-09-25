@php
    $site = site();
@endphp

<footer class="relative z-20 pb-8 px-6" aria-label="Site footer">
    <div class="max-w-6xl mx-auto">
        <hr class="border-gray-300 dark:border-gray-600 mb-8" />
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            {{-- Logo --}}
            <div class="shrink-0 w-32 md:w-40">
                <a href="{{ $site->url() }}" aria-label="{{ $site->title() }} — Go to homepage">
                    <x-svg.logo />
                </a>
            </div>

            {{-- Copyright --}}
            <div class="text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ date('Y') }} all rights reserved {{ $site->title() }}
                </p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Contractor Licence 904934</p>
            </div>

            {{-- Social icons --}}
            <div class="flex items-center gap-4" role="list" aria-label="Social media links">
                @if ($site->facebook()->isNotEmpty())
                    <a href="{{ $site->facebook() }}" target="_blank" rel="noopener" aria-label="Facebook" role="listitem" class="text-red-600 hover:text-red-700 transition duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                @endif
                @if ($site->instagram()->isNotEmpty())
                    <a href="{{ $site->instagram() }}" target="_blank" rel="noopener" aria-label="Instagram" role="listitem" class="text-red-600 hover:text-red-700 transition duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                @endif
            </div>
        </div>
        <div class="mt-8 flex justify-end">
            <a href="https://webxpress.website" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition duration-200">
                <span>Designed and Developed by <strong class="font-semibold">Webxpress</strong></span>
                <img src="/webxpress.svg" alt="" class="h-5 w-auto" width="19" height="20" loading="lazy" />
            </a>
        </div>
    </div>
</footer>
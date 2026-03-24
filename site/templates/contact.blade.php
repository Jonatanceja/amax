@php
    /**
     * @var Kirby\Cms\App $kirby
     * @var Kirby\Cms\Page $page
     * @var Kirby\Cms\Site $site
     */
    $siteObj = site();
    $services = $page->services_list()->split(',');
@endphp

<x-layout>
    <section class="relative h-[33vh] md:h-[50vh]">
        @if ($image = $page->cover()->toFile())
            <x-ui.picture :image="$image" alt="{{ $page->title() }}" class="w-full h-full object-cover z-0" :eager="true" />
            <div class="absolute inset-0 z-10 bg-black/50 flex items-center justify-center">
                <h1 class="text-white text-4xl md:text-5xl lg:text-8xl font-bold text-center px-4 max-w-5xl mt-20">{{ $page->title() }}</h1>
            </div>
        @endif
    </section>

    <div class="max-w-6xl mx-auto px-6 z-20 relative py-16">
        <div class="flex flex-col md:flex-row gap-12">

            {{-- Left column: Info + Map --}}
            <div class="w-full md:w-1/2">
                @if ($page->headline()->isNotEmpty())
                    <h2 class="text-4xl font-bold mb-8 text-gray-800 dark:text-white">{{ $page->headline() }}</h2>
                @endif

                <div class="space-y-4 mb-8">
                    @if ($siteObj->address()->isNotEmpty())
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-600 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-gray-600 dark:text-gray-400">{{ $siteObj->address() }}</p>
                        </div>
                    @endif

                    @if ($siteObj->phone()->isNotEmpty())
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:{{ $siteObj->phone() }}" class="text-gray-600 dark:text-gray-400 hover:text-red-600 transition">{{ $siteObj->phone() }}</a>
                        </div>
                    @endif

                    @if ($siteObj->email()->isNotEmpty())
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ $siteObj->email() }}" class="text-gray-600 dark:text-gray-400 hover:text-red-600 transition">{{ $siteObj->email() }}</a>
                        </div>
                    @endif
                </div>

                @if ($page->map_embed()->isNotEmpty())
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <iframe
                            src="{{ $page->map_embed() }}"
                            title="Map showing location of {{ site()->title() }}"
                            width="100%"
                            height="300"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>
                @endif
            </div>

            {{-- Right column: Form --}}
            <div class="w-full md:w-1/2">
                @if ($success)
                    <div class="bg-white/50 dark:bg-gray-700/50 border border-white dark:border-gray-600 backdrop-blur-sm shadow-2xl rounded-lg p-8 text-center">
                        <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Thank you!</h3>
                        <p class="text-gray-600 dark:text-gray-400">We'll get back to you soon.</p>
                    </div>
                @else
                    <form
                        method="POST"
                        action="{{ $page->url() }}"
                        class="bg-white/50 dark:bg-gray-700/50 border border-white dark:border-gray-600 backdrop-blur-sm shadow-2xl rounded-lg p-8 space-y-5"
                    >
                        <input type="hidden" name="contact_form" value="1">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Get a Free Quote</h3>

                        @if ($error)
                            <div role="alert" class="bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-400 p-4 rounded-lg text-sm">
                                {!! $error !!}
                            </div>
                        @endif

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                            <input type="text" id="name" name="name" required value="{{ $data['name'] ?? '' }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" id="email" name="email" required value="{{ $data['email'] ?? '' }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                            <input type="tel" id="phone" name="phone" value="{{ $data['phone'] ?? '' }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition">
                        </div>

                        <div>
                            <label for="service" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type of Service</label>
                            <select id="service" name="service" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition">
                                <option value="">Select a service</option>
                                @foreach ($services as $service)
                                    <option value="{{ trim($service) }}" {{ ($data['service'] ?? '') === trim($service) ? 'selected' : '' }}>{{ trim($service) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message</label>
                            <textarea id="message" name="message" rows="4"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition resize-none">{{ $data['message'] ?? '' }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full transition duration-200">
                            Send Message
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</x-layout>

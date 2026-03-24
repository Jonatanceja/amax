<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="@csrf()">

    @php
        $metaTitle = page()->metaTitle()->isNotEmpty() ? page()->metaTitle() : page()->title() . ' | ' . site()->title();
        $metaDesc = page()->metaDescription()->isNotEmpty() ? page()->metaDescription() : site()->title() . ' — Quality construction and renovation services.';
        $ogImage = page()->ogImage()->toFile() ?? page()->cover()->toFile();
    @endphp

    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:url" content="{{ page()->url() }}">
    <meta property="og:site_name" content="{{ site()->title() }}">
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage->thumb(['width' => 1200, 'height' => 630, 'crop' => true, 'format' => 'jpg'])->url() }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDesc }}">
    @if ($ogImage)
        <meta name="twitter:image" content="{{ $ogImage->thumb(['width' => 1200, 'height' => 630, 'crop' => true, 'format' => 'jpg'])->url() }}">
    @endif

    <script>
        (function(){
            var t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <link rel="canonical" href="{{ page()->url() }}">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans antialiased dark:bg-gray-900 bg-gray-100 bg-grid relative z-0">
    <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[60] focus:bg-red-600 focus:text-white focus:px-4 focus:py-2 focus:rounded-lg">Skip to content</a>
    <x-ui.nav
    phone="{{ site()->phone() }}"
    phonelink="tel:{{ site()->phone() }}"
    ctaText="Get a free quote"
    ctaUrl="/contact"
    quoteText="Request a quote"
    />
    <main id="content">
        {{ $slot }}
    </main>
    <x-ui.footer />
</body>

</html>

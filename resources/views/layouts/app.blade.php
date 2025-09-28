<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Porównywarka finansowa')</title>
    <meta name="description" content="@yield('meta_description','Porównaj pożyczki, karty i ubezpieczenia')">

    {{-- Robots + canonical (overridable per view) --}}
    <meta name="robots" content="@yield('meta_robots', app()->isProduction() ? 'index,follow' : 'noindex,nofollow')">
    <link rel="canonical" href="@yield('canonical', app(\App\Support\Canonical::class)->build(request()))">

    {{-- Open Graph / Twitter (fallbacks to title/description above) --}}
    <meta property="og:locale" content="pl_PL">
    <meta property="og:type" content="@yield('og_type','website')">
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title','Porównywarka finansowa'))">
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description','Porównaj pożyczki, karty i ubezpieczenia'))">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', View::yieldContent('title','Porównywarka finansowa'))">
    <meta name="twitter:description" content="@yield('og_description', View::yieldContent('meta_description','Porównaj pożyczki, karty i ubezpieczenia'))">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta name="mylead-verification" content="b5937cc503ef3ddcd8143752d5fa1a88">
    <meta name="convertiser-verification" content="60598e1813655a529d4a7b7650a53d34e6b02732" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-specific extras (JSON-LD etc.) --}}

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZEYRWM1D6H"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-ZEYRWM1D6H');
    </script>

    @stack('meta')
</head>

<body class="min-h-screen flex flex-col bg-slate-50 text-slate-900 antialiased">

<!-- Header -->
@include('layouts.header')

<!-- Main -->
<main class="flex-1">
    @yield('content')
</main>

<!-- Footer -->
@include('layouts.footer')

<!-- Tiny JS for the burger -->
<script>
    (function () {
        const btn   = document.getElementById('menuBtn');
        const panel = document.getElementById('mobileMenu');
        const openI = document.getElementById('iconOpen');
        const closeI= document.getElementById('iconClose');

        if (!btn || !panel) return;

        function toggleMenu(force) {
            const willOpen = typeof force === 'boolean' ? force : panel.classList.contains('hidden');
            panel.classList.toggle('hidden', !willOpen);
            openI.classList.toggle('hidden', willOpen);
            closeI.classList.toggle('hidden', !willOpen);
            btn.setAttribute('aria-expanded', String(willOpen));
        }

        btn.addEventListener('click', () => toggleMenu());

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') toggleMenu(false);
        });

        panel.addEventListener('click', (e) => {
            const a = e.target.closest('a');
            if (a) toggleMenu(false);
        });
    })();
</script>

<!-- Cookie consent -->
@include('partials.tracking')
@stack('blocked-tags')
@include('partials.cookie-consent')
</body>
</html>

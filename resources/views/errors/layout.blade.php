<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ url()->current() }}">
    <title>@yield('title', 'Błąd')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50 text-brand-900">

<section class="relative min-h-screen flex items-center justify-center">

    <div class="absolute inset-0 bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900"></div>
    <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>

    <div class="relative w-full max-w-3xl mx-auto p-6">
        <div class="rounded-2xl bg-white/95 backdrop-blur shadow-xl border border-black/5 p-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-10 w-10 grid place-items-center rounded-xl bg-brand-400/15 text-brand-400">
                    @yield('icon')
                </div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight">@yield('heading')</h1>
            </div>
            <img src="{{ asset('images/error-logo.png') }}" srcset="{{ asset('images/error-logo.png') }} 1x, {{ asset('images/error-logo@2x.png') }} 2x" alt="FinWybor • błąd" class="block h-12 md:h-16 w-auto object-contain mb-4"
            />
            <p class="text-slate-600">@yield('message')</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ url('/') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-brand-400 hover:bg-brand-500 text-white font-semibold shadow-soft">
                    Wróć na stronę główną
                </a>
                <a href="{{ route('offers.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-black/10 bg-white text-brand-900 hover:bg-slate-50">
                    Zobacz oferty
                </a>
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-black/10 bg-white text-brand-900 hover:bg-slate-50">
                    Przeczytaj artykuły
                </a>
            </div>
            @yield('extra')
        </div>

        <div class="mt-6 text-center text-xs text-white/70">
            Kod błędu: @yield('code', '—')
        </div>
    </div>
</section>
</body>
</html>

@extends('layouts.app')
@include('static._meta_cookies')

@section('content')
    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
            <nav class="text-xs text-white/70 mb-3" aria-label="breadcrumbs">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                    <li aria-hidden>›</li>
                    <li class="text-white/90">Pliki cookies</li>
                </ol>
            </nav>

            <h1 class="text-2xl md:text-4xl font-bold tracking-tight">Pliki cookies</h1>
            <p class="mt-2 text-white/85 max-w-2xl">
                Wyjaśniamy, jak używamy plików cookies i podobnych technologii, oraz jak możesz zarządzać zgodami.
            </p>
        </div>
    </section>

    <div class="max-w-3xl mx-auto px-4 md:px-6 py-10 space-y-8">
        <div class="not-prose mb-6 md:mb-8 flex flex-wrap gap-x-4 gap-y-3">
            @php $cats=[
      ['#essential','Niezbędne'],
      ['#analytics','Analityczne'],
      ['#affiliate','Afiliacyjne'],
      ['#prefs','Preferencje'],
    ]; @endphp
            @foreach($cats as [$href,$label])
                <a href="{{ $href }}"
                   class="px-3 py-1.5 rounded-lg border border-brand-800/20 bg-brand-800/8 text-sm text-brand-900 hover:bg-brand-800/12">
                    {{ $label }}
                </a>
            @endforeach
        </div>


        <div class="prose prose-slate max-w-none prose-p:leading-relaxed">
            <h2>Co to są cookies?</h2>
            <p>Cookies to niewielkie pliki zapisywane na Twoim urządzeniu. Używamy ich, aby zapewnić działanie serwisu,
                poprawić ergonomię oraz mierzyć statystyki w sposób zagregowany.</p>

            <h2 id="essential">Niezbędne (bez zgody)</h2>
            <p>Zapewniają podstawowe funkcje (np. nawigacja, bezpieczeństwo, ustawienia sesji). Bez nich serwis nie działa poprawnie.</p>

            <h2 id="analytics">Analityczne (wymagają zgody)</h2>
            <p>Służą do anonimowego pomiaru ruchu i użyteczności. W każdej chwili możesz wycofać zgodę.</p>

            <h2 id="affiliate">Afiliacyjne (wymagają zgody)</h2>
            <p>Pomagają w rozliczeniach z sieciami partnerskimi (np. Awin). Zawierają anonimowe identyfikatory kampanii
                — nie przechowujemy danych wrażliwych.</p>

            <h2 id="prefs">Preferencje</h2>
            <p>Zapamiętują Twoje wybory (np. ostatnio używane filtry), aby ułatwić kolejne wizyty.</p>

            <h2>Zarządzanie zgodami</h2>
            <ul>
                <li>W każdej chwili możesz zmienić ustawienia w banerze zgód (jeżeli jest widoczny) lub w przeglądarce.</li>
                <li>Wycofanie zgody nie wpływa na legalność przetwarzania sprzed jej wycofania.</li>
            </ul>

            <p>Więcej informacji znajdziesz w <a href="{{ route('privacy') }}">Polityce prywatności</a>.</p>
        </div>

        {{-- Optional: simple key/value cards --}}
        <div class="not-prose grid sm:grid-cols-2 gap-3">
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Okres przechowywania</div>
                <div class="mt-1 text-sm text-slate-700">Zależny od kategorii i ustawień przeglądarki.</div>
            </div>
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Wycofanie zgody</div>
                <div class="mt-1 text-sm text-slate-700">Możesz cofnąć w każdej chwili — wpływa na przyszłe przetwarzanie.</div>
            </div>
        </div>
    </div>
@endsection

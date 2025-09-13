@extends('layouts.app')
@include('static._meta_about')

@section('content')
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
            <nav class="text-xs text-white/70 mb-3" aria-label="breadcrumbs">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                    <li aria-hidden>›</li>
                    <li class="text-white/90">O nas</li>
                </ol>
            </nav>

            <h1 class="text-2xl md:text-4xl font-bold tracking-tight">O nas</h1>
            <p class="mt-2 text-white/85 max-w-2xl">
                FinWybor.pl to prosta porównywarka finansowa. Pomagamy szybko porównać oferty i podjąć świadomą decyzję.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 space-y-8">
        <div class="not-prose mb-6 md:mb-8 grid sm:grid-cols-3 gap-3">
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Misja</div>
                <div class="mt-1 font-semibold text-brand-900">Przejrzyste porównania</div>
            </div>
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Zakres</div>
                <div class="mt-1 font-semibold text-brand-900">Pożyczki, karty, ubezpieczenia</div>
            </div>
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Kontakt</div>
                <div class="mt-1 font-semibold">
                    <a href="{{ route('contact.create') }}" class="text-brand-600 hover:text-brand-500 underline">
                        Formularz kontaktowy
                    </a>
                </div>
            </div>
        </div>

        <div class="prose prose-slate max-w-none prose-p:leading-relaxed">
            <h2>Kim jesteśmy</h2>
            <p>Jesteśmy niezależnym serwisem informacyjnym. Zbieramy i porównujemy informacje o ofertach finansowych
                w przystępnej formie. Nie udzielamy pożyczek ani nie zawieramy umów w imieniu dostawców.</p>

            <h2>Jak zarabiamy (pełna transparentność)</h2>
            <p>Niektóre linki w serwisie są <strong>partnerskie</strong>. Jeśli złożysz wniosek u dostawcy, możemy
                otrzymać prowizję. To <strong>nie wpływa</strong> na cenę po Twojej stronie ani na wyniki sortowania,
                które sam wybierasz (np. „najtaniej”, „najszybciej”).</p>

            <h2>Zasady redakcyjne</h2>
            <ul>
                <li>Język prosty, bez żargonu.</li>
                <li>Aktualność i korekta danych ofertowych.</li>
                <li>Wyraźne oznaczanie treści partnerskich.</li>
            </ul>

            <h2>Dane podmiotu</h2>
            <p>FinWybor.pl — serwis internetowy. Działamy online. Dane kontaktowe dostępne na stronie
                <a href="{{ route('contact.create') }}">Kontakt</a>. (Jeżeli działasz jako firma, dodaj NIP/REGON i adres.)</p>
        </div>

        <div class="not-prose grid sm:grid-cols-2 gap-3">
            <a href="{{ route('offers.index') }}" class="rounded-xl border border-brand-800/20 bg-white p-4 shadow-card hover:bg-slate-50">
                <div class="text-sm text-slate-500">Sprawdź</div>
                <div class="mt-1 font-semibold text-brand-900">Porównaj oferty</div>
            </a>
            <a href="{{ route('posts.index') }}" class="rounded-xl border border-brand-800/20 bg-white p-4 shadow-card hover:bg-slate-50">
                <div class="text-sm text-slate-500">Czytaj</div>
                <div class="mt-1 font-semibold text-brand-900">Artykuły i poradniki</div>
            </a>
        </div>
    </div>
@endsection

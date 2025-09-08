@extends('layouts.app')
@section('title','Pożyczki, karty, ubezpieczenia – porównywarka')
@section('meta_description','Szybko porównaj RRSO, ratę, całkowity koszt i czas wypłaty.')

@section('content')
    <section class="relative isolate overflow-hidden bg-hero-gradient text-white">
        <div class="absolute inset-0 pointer-events-none bg-grid-faint"></div>
        <div class="relative max-w-7xl mx-auto px-4 md:px-6 pt-10 pb-16 md:pt-14 md:pb-20">
            @include('partials.hero')
        </div>
    </section>
    <section class="py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-3 gap-6">
            <div class="rounded-xl2 bg-white shadow-card border border-slate-200/60 p-6">
                <div class="text-brand-800 font-semibold text-lg">Pożyczki</div>
                <p class="text-slate-600 mt-2">
                    Od ręki, jasno, bez ukrytych kosztów. Porównaj RRSO i terminy.
                </p>
                <a href="{{ route('offers.loans') }}"
                   class="mt-4 inline-flex items-center gap-2 text-brand-700 hover:text-brand-500">
                    Zobacz oferty
                    <span aria-hidden>→</span>
                </a>
            </div>

            <div class="rounded-xl2 bg-white shadow-card border border-slate-200/60 p-6">
                <div class="text-brand-800 font-semibold text-lg">Karty kredytowe</div>
                <p class="text-slate-600 mt-2">
                    Okres bezodsetkowy, cashback, brak opłaty rocznej – wybierz najlepszą.
                </p>
                <a href="{{ route('offers.cards') }}"
                   class="mt-4 inline-flex items-center gap-2 text-brand-700 hover:text-brand-500">
                    Zobacz oferty
                    <span aria-hidden>→</span>
                </a>
            </div>

            <div class="rounded-xl2 bg-white shadow-card border border-slate-200/60 p-6">
                <div class="text-brand-800 font-semibold text-lg">Ubezpieczenia</div>
                <p class="text-slate-600 mt-2">
                    OC/AC, podróżne, nieruchomości – sprawdź składkę i zakres.
                </p>
                <a href="{{ route('offers.insurance') }}"
                   class="mt-4 inline-flex items-center gap-2 text-brand-700 hover:text-brand-500">
                    Zobacz oferty
                    <span aria-hidden>→</span>
                </a>
            </div>
        </div>
    </section>
@endsection

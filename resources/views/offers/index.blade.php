@extends('layouts.app')
@include('offers._meta', ['type' => $type, 'amount' => $amount, 'term' => $term, 'sort' => $sort, 'offers' => $offers ?? []])
@section('content')
    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
            <nav class="text-xs text-white/70 mb-2" aria-label="breadcrumbs">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                    <li aria-hidden>›</li>
                    <li class="text-white/90">Porównanie ofert</li>
                </ol>
            </nav>
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Porównanie ofert</h1>
            <p class="mt-2 text-sm md:text-base text-white/85">Filtruj, sortuj i wybierz najlepszy produkt dla siebie.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 md:px-6 -mt-6">
        {{-- Sticky filter bar --}}
        <form id="offers-filter" method="get" action="{{ route('offers.index') }}"
              class="bg-white rounded-xl shadow-soft border border-black/5 p-4 md:p-5 sticky top-2 z-10">
            <div class="grid grid-cols-2 md:grid-cols-12 gap-3">
                {{-- Typ --}}
                <div class="md:col-span-3">
                    <label class="text-[11px] uppercase tracking-wide text-brand-800/80">Typ</label>
                    <select name="type"
                            class="mt-1 w-full rounded-lg border border-black/10 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-400">
                        <option value="loan" @if($type==='loan') selected @endif>Pożyczki</option>
                        <option value="card" @if($type==='card') selected @endif>Karty kredytowe</option>
                        <option value="insurance" @if($type==='insurance') selected @endif>Ubezpieczenia</option>
                    </select>
                </div>

                {{-- Kwota --}}
                <div class="md:col-span-3">
                    <label class="text-[11px] uppercase tracking-wide text-brand-800/80">Kwota (PLN)</label>
                    <input type="number" name="amount" value="{{ $amount }}"
                           class="mt-1 w-full rounded-lg border border-black/10 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-400"
                           min="100" step="100" placeholder="np. 3000">
                </div>

                {{-- Okres --}}
                <div class="md:col-span-2">
                    <label class="text-[11px] uppercase tracking-wide text-brand-800/80">Okres (mies.)</label>
                    <input type="number" name="term" value="{{ $term }}"
                           class="mt-1 w-full rounded-lg border border-black/10 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-400"
                           min="1" max="120" placeholder="np. 6">
                </div>

                {{-- Sort --}}
                <div class="md:col-span-2">
                    <label class="text-[11px] uppercase tracking-wide text-brand-800/80">Sortuj</label>
                    <select name="sort"
                            class="mt-1 w-full rounded-lg border border-black/10 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-400">
                        <option value="brand" @if($sort==='brand') selected @endif>Alfabetycznie</option>
                        <option value="cheapest" @if($sort==='cheapest') selected @endif>Najtaniej (nadpłata)</option>
                        <option value="fastest" @if($sort==='fastest') selected @endif>Najszybsza wypłata</option>
                        <option value="popular" @if($sort==='popular') selected @endif>Najpopularniejsze</option>
                    </select>
                </div>

                {{-- Search (brand) --}}
                <div class="md:col-span-2">
                    <label class="text-[11px] uppercase tracking-wide text-brand-800/80">Szukaj</label>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="Nazwa banku / marki"
                           class="mt-1 w-full rounded-lg border border-black/10 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-400">
                </div>

                {{-- CTA + quick chips --}}
                <div class="col-span-2 md:col-span-12 order-last md:order-none">
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
                        {{-- Quick chips (AJAX-enhanced) --}}
                        <div class="flex flex-wrap items-center gap-2">
                            <a data-ajax href="{{ route('offers.index', array_merge(request()->except('sort','type'), ['type'=>'loan','sort'=>'fastest'])) }}"
                               class="px-3 py-1.5 rounded-lg border border-brand-800/20 text-brand-800 bg-brand-800/5 hover:bg-brand-800/10 text-xs">
                                Najszybsza wypłata
                            </a>
                            <a data-ajax href="{{ route('offers.index', array_merge(request()->except('sort','type'), ['type'=>'loan','sort'=>'cheapest'])) }}"
                               class="px-3 py-1.5 rounded-lg border border-brand-800/20 text-brand-800 bg-brand-800/5 hover:bg-brand-800/10 text-xs">
                                Najtaniej
                            </a>
                            <a data-ajax href="{{ route('offers.index', array_merge(request()->except('type','sort'), ['type'=>'card'])) }}"
                               class="px-3 py-1.5 rounded-lg border border-brand-800/20 text-brand-800 bg-brand-800/5 hover:bg-brand-800/10 text-xs">
                                Karty bez opłaty
                            </a>
                        </div>

                        {{-- Big CTA --}}
                        <button
                            class="w-full md:w-auto inline-flex items-center justify-center gap-2
                                   bg-brand-400 hover:bg-brand-500 text-white px-5 py-3
                                   rounded-lg font-semibold shadow-soft">
                            Pokaż wyniki
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Results surface (skeleton + list) --}}
        <div id="offers-surface" class="mt-6 relative">
            <div id="offers-skeleton" class="hidden absolute inset-0 z-20">
                @include('offers._skeleton')
            </div>
            <div id="offers-results" class="min-h-[360px]">
                @include('offers._list')
            </div>
        </div>

        <div class="mt-6 text-xs text-black/60">
            Informacje nie stanowią rekomendacji. Przed podjęciem decyzji zapoznaj się z dokumentami ofertowymi dostawcy.
        </div>
    </div>

    {{-- AJAX + skeleton controller --}}
    @push('scripts')
        <script>
            (function () {
                const form     = document.getElementById('offers-filter');
                const results  = document.getElementById('offers-results');
                const skeleton = document.getElementById('offers-skeleton');

                const showSkeleton = () => { skeleton.classList.remove('hidden'); results.setAttribute('aria-busy', 'true'); };
                const hideSkeleton = () => { skeleton.classList.add('hidden');   results.removeAttribute('aria-busy');       };

                async function ajaxLoad(url) {
                    showSkeleton();
                    try {
                        const resp = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                        if (!resp.ok) throw new Error('Network response was not ok');
                        const html = await resp.text();
                        results.innerHTML = html;
                        window.history.pushState({}, '', url);
                        bindAjaxLinks();
                    } catch (e) {
                        console.error(e);
                        window.location.href = url;
                    } finally {
                        hideSkeleton();
                    }
                }

                function bindAjaxLinks() {
                    document.querySelectorAll('a[data-ajax]').forEach(a => {
                        a.addEventListener('click', (e) => {
                            if (e.metaKey || e.ctrlKey) return;
                            e.preventDefault();
                            ajaxLoad(a.href);
                        }, { passive: false });
                    });
                    results.querySelectorAll('a').forEach(a => {
                        if (a.closest('.pagination') || a.rel === 'next' || a.rel === 'prev') {
                            a.setAttribute('data-ajax', 'true');
                        }
                    });
                }

                if (form) {
                    form.querySelectorAll('select,input[type="number"],input[type="text"]').forEach(el => {
                        el.addEventListener('change', () => form.requestSubmit());
                    });
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        const qs = new URLSearchParams(new FormData(form)).toString();
                        ajaxLoad(form.action + '?' + qs);
                    });
                }

                bindAjaxLinks();
                window.addEventListener('popstate', () => ajaxLoad(location.href));
            })();
        </script>
    @endpush
@endsection

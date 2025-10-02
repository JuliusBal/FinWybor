@extends('layouts.app')
@include('posts._meta_index', ['posts' => $posts,'categories' => $categories,'catSlug' => $catSlug ?? null,'sort' => $sort ?? 'newest','q' => $q ?? '',])
@section('content')
    {{-- HERO / BANNER --}}
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white overflow-hidden">
        {{-- opcjonalnie: lekka siatka jak wcześniej --}}
        <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
            <nav class="text-xs text-white/70 mb-3" aria-label="breadcrumbs">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                    <li aria-hidden>›</li>
                    <li class="text-white/90">Artykuły</li>
                </ol>
            </nav>

            <div class="flex items-center gap-3">
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold tracking-tight">Artykuły i poradniki</h1>
                    <p class="text-white/80 mt-1">Finanse osobiste, pożyczki, karty, ubezpieczenia — prosto i
                        konkretnie.</p>
                </div>
            </div>

            {{-- Toolbar: search + sort --}}
            <div class="mt-6 bg-white/10 backdrop-blur border border-white/10 rounded-xl2 p-3 md:p-4">
                <form method="get" action="{{ route('posts.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3">
                    {{-- Preserve current category filter when searching --}}
                    <input type="hidden" name="category" value="{{ $catSlug ?? request('category') }}"/>

                    <div class="md:col-span-8 flex">
                        <label class="sr-only">Szukaj</label>
                        <input
                            type="text"
                            name="q"
                            value="{{ old('q', $q ?? '') }}"
                            placeholder="Szukaj artykułów (np. RRSO, karta, OC)"
                            class="w-full rounded-lg bg-white/95 text-brand-900 px-3 py-2 h-full focus:outline-none focus:ring-2 focus:ring-brand-300"
                        >
                    </div>

                    <div class="md:col-span-2 flex">
                        <select name="sort"
                                class="w-full rounded-lg bg-white/95 text-brand-900 px-3 py-2 h-full focus:outline-none focus:ring-2 focus:ring-brand-300">
                            <option value="newest" @selected(($sort ?? 'newest') === 'newest')>Najnowsze</option>
                            <option value="popular" @selected(($sort ?? '') === 'popular')>Popularne</option>
                            <option value="az" @selected(($sort ?? '') === 'az')>A–Z</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 flex">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-lg
                       bg-brand-400 hover:bg-brand-500 text-white font-semibold shadow-glow
                       px-4 py-2 h-full cursor-pointer">
                            Szukaj
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                 fill="currentColor">
                                <path
                                    d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79L20 21.5 21.5 20 15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                {{-- Category chips --}}
                @if(($categories ?? null) && $categories->count())
                    <div class="mt-3 flex gap-2 flex-wrap">
                        @php $active = $catSlug ?? request('category'); @endphp

                        @foreach($categories as $cat)
                            @php $isActive = $active === $cat->slug; @endphp
                            <a href="{{ route('categories.show',
                        array_merge(
                            ['category' => $cat->slug],
                            request()->except('page','category')
                        )
                    ) }}"
                               class="px-3 py-1.5 rounded-lg border text-sm transition
                      {{ $isActive
                         ? 'bg-brand-400 text-white border-brand-400 shadow-glow'
                         : 'bg-white/10 hover:bg-white/15 border-white/10 text-white/90' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach

                        @if($active)
                            <a href="{{ route('posts.index', request()->except('category','page')) }}"
                               class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 border border-white/10 text-sm">
                                Wyczyść filtr
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        @if($posts->count())
            @php $first = $posts->first(); @endphp
            @if($first)
                <article class="mb-8 overflow-hidden rounded-2xl bg-white border border-slate-200/60 shadow-card">
                    <a href="{{ route('posts.show', $first->slug) }}" class="grid md:grid-cols-12">
                        <div class="md:col-span-7">
                            @if($first->thumbnail_url)
                                <img src="{{ $first->thumbnail_url }}" alt="{{ $first->title }}"
                                     class="w-full h-64 md:h-full object-cover">
                            @else
                                <div
                                    class="w-full h-64 md:h-full bg-gradient-to-br from-brand-300/30 to-brand-400/20"></div>
                            @endif
                        </div>
                        <div class="md:col-span-5 p-6 md:p-8">
                            <div class="flex items-center gap-2 text-xs text-slate-500">
                                @if($first->category?->name)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full bg-brand-800/10 text-brand-800 border border-brand-800/20">
                                        {{ $first->category->name }}
                                    </span>
                                @endif
                                @if($first->published_at)
                                    <span>{{ $first->published_at->format('Y-m-d') }}</span>
                                @endif
                            </div>
                            <h2 class="text-xl md:text-2xl font-bold mt-2 text-brand-900">{{ $first->title }}</h2>
                            @if($first->excerpt)
                                <p class="mt-3 text-slate-600 line-clamp-4">{{ $first->excerpt }}</p>
                            @endif
                            <span class="mt-4 inline-flex items-center gap-2 text-brand-600 font-semibold">
                                Czytaj dalej
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                     fill="currentColor"><path
                                        d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                            </span>
                        </div>
                    </a>
                </article>
            @endif

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    @continue($loop->first) {{-- skip featured --}}
                    <article
                        class="group bg-white rounded-xl shadow-card border border-slate-200/60 overflow-hidden hover:shadow-lg transition-shadow">
                        <a href="{{ route('posts.show', $post->slug) }}" class="block">
                            @if($post->thumbnail_url)
                                <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                                     class="w-full h-44 object-cover">
                            @else
                                <div class="w-full h-44 bg-gradient-to-br from-brand-300/30 to-brand-400/20"></div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    @if($post->category?->name)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full bg-brand-800/10 text-brand-800 border border-brand-800/20">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    @if($post->published_at)
                                        <span>{{ $post->published_at->format('Y-m-d') }}</span>
                                    @endif
                                </div>
                                <h3 class="mt-2 text-base font-semibold text-brand-900 line-clamp-2 group-hover:underline">{{ $post->title }}</h3>
                                @if($post->excerpt)
                                    <p class="mt-2 text-slate-600 line-clamp-3">{{ $post->excerpt }}</p>
                                @endif
                                <span class="mt-3 inline-flex items-center gap-1 text-brand-600">
                                    Czytaj
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24"
                                         fill="currentColor"><path
                                            d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                {{ $posts->onEachSide(1)->links('vendor.pagination.tailwind') }}
            </div>
        @else
            {{-- Empty state --}}
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-card p-8 text-center">
                    <div class="mx-auto w-14 h-14 rounded-xl grid place-items-center bg-brand-400/15 text-brand-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4 6h16v2H4V6zm0 5h10v2H4v-2zm0 5h16v2H4v-2z"/>
                        </svg>
                    </div>
                    <h2 class="mt-4 text-lg font-semibold text-brand-900">Brak artykułów</h2>
                    <p class="mt-1 text-slate-600">Spróbuj innego słowa kluczowego lub wyczyść filtry.</p>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <a href="{{ route('posts.index') }}"
                           class="px-4 py-2 rounded-lg bg-brand-400 hover:bg-brand-500 text-white font-semibold shadow-soft">Wyczyść</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <section class="max-w-7xl mx-auto px-4 md:px-6 pb-10">
        <div
            class="rounded-2xl bg-brand-900 text-white p-6 md:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <div class="text-sm text-white/70">Zostań na bieżąco</div>
                <h3 class="text-xl md:text-2xl font-bold mt-1">Nowe artykuły prosto na mail</h3>
                <p class="text-white/70 mt-1">Zero spamu. Tylko praktyczne porady i porównania.</p>
            </div>

            <form id="newsletter-form" method="post" action="{{ route('newsletter.subscribe') }}"
                  class="w-full md:w-auto flex flex-col sm:flex-row gap-2 sm:items-stretch">
                @csrf
                <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                <input
                    type="email"
                    name="email"
                    required
                    placeholder="Twój e-mail"
                    value="{{ old('email') }}"
                    class="w-full sm:flex-1 sm:min-w-0 md:w-72 rounded-lg bg-white/95 text-brand-900 px-3 py-2
               focus:outline-none focus:ring-2 focus:ring-brand-300 @error('email') ring-2 ring-red-300 @enderror"
                >

                <button type="submit" id="newsletter-btn"
                        class="w-full sm:w-auto flex-shrink-0 inline-flex items-center justify-center gap-2 rounded-lg
                   bg-brand-400 hover:bg-brand-500 text-white font-semibold shadow-glow px-4 py-2">
                    Subskrybuj
                </button>
            </form>

            {{-- inline messages (works for AJAX + normal POST) --}}
            <div id="newsletter-msg" class="w-full md:w-auto text-sm">
                @if(session('newsletter_ok'))
                    <div class="text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-3 py-2">
                        {{ session('newsletter_ok') }}
                    </div>
                @endif
                @if(session('newsletter_err'))
                    <div class="text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                        {{ session('newsletter_err') }}
                    </div>
                @endif
                @error('email')
                <div class="text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            (() => {
                const form = document.getElementById('newsletter-form');
                if (!form || !window.fetch) return;

                const btn = document.getElementById('newsletter-btn');
                const msg = document.getElementById('newsletter-msg');

                const showNotice = (text, ok = true) => {
                    msg.innerHTML = '';
                    const box = document.createElement('div');
                    box.className = (ok
                            ? 'text-emerald-700 bg-emerald-50 border border-emerald-200'
                            : 'text-red-700 bg-red-50 border border-red-200'
                    ) + ' rounded-lg px-3 py-2';
                    box.textContent = text;
                    msg.appendChild(box);
                };

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    btn.disabled = true;
                    try {
                        const res = await fetch(form.action, {
                            method: 'POST',
                            headers: {'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json'},
                            body: new FormData(form)
                        });
                        if (res.ok) {
                            const json = await res.json();
                            showNotice(json.message || 'Dziękujemy! Sprawdź swoją skrzynkę.', true);
                            form.reset();
                        } else if (res.status === 422) {
                            const json = await res.json();
                            showNotice(json.errors?.email?.[0] || 'Podaj poprawny adres e-mail.', false);
                        } else {
                            showNotice('Ups… Spróbuj ponownie za chwilę.', false);
                        }
                    } catch {
                        showNotice('Błąd połączenia. Spróbuj ponownie.', false);
                    } finally {
                        btn.disabled = false;
                    }
                });
            })();
        </script>
    @endpush
@endsection

@extends('layouts.app')
@include('static._meta_contact')
@section('content')
        <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
            <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
                <nav class="text-xs text-white/70 mb-3" aria-label="breadcrumbs">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                        <li aria-hidden>›</li>
                        <li class="text-white/90">Kontakt</li>
                    </ol>
                </nav>
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <h1 class="text-2xl md:text-4xl font-bold tracking-tight">Kontakt</h1>
                        <p class="mt-2 text-white/85 max-w-2xl">
                            Masz pytanie? Napisz do nas — zwykle odpowiadamy w ciągu 24 godzin. Krótko, konkretnie i po ludzku.
                        </p>

                        <div class="mt-4 flex flex-wrap items-center gap-2 text-xs">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">
                            <span class="opacity-90">✓</span> 24h odpowiedź
                        </span>
                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">
                            <span class="opacity-90">✓</span> 100% online
                        </span>
                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/10 border border-white/10">
                            <span class="opacity-90">✓</span> Prywatność & bezpieczeństwo
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <div class="grid md:grid-cols-12 gap-6">
            <div class="md:col-span-7">
                @if(session('success'))
                    <div class="mb-4 rounded-xl border border-emerald-300/40 bg-emerald-50 text-emerald-800 px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="post" action="{{ route('contact.store') }}"
                      class="bg-white rounded-2xl shadow-card border border-slate-200/60 p-5 md:p-6 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-800">Imię i nazwisko</label>
                        <input name="name" value="{{ old('name') }}"
                               class="mt-1 w-full rounded-lg border px-3 py-2
                               @error('name') border-red-300 focus:ring-red-300
                               @else border-black/10 focus:ring-brand-400 @enderror
                               focus:outline-none focus:ring-2">
                        @error('name')
                        <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-800">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="mt-1 w-full rounded-lg border px-3 py-2
                               @error('email') border-red-300 focus:ring-red-300
                               @else border-black/10 focus:ring-brand-400 @enderror
                               focus:outline-none focus:ring-2">
                        @error('email')
                        <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-800">Wiadomość</label>
                        <textarea name="message" rows="6"
                                  class="mt-1 w-full rounded-lg border px-3 py-2 resize-y
                                  @error('message') border-red-300 focus:ring-red-300
                                  @else border-black/10 focus:ring-brand-400 @enderror
                                  focus:outline-none focus:ring-2">{{ old('message') }}</textarea>
                        @error('message')
                        <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex items-start gap-2 text-sm">
                        <input id="consent" type="checkbox" name="consent" class="mt-1 rounded border-black/20 text-brand-400 focus:ring-brand-400">
                        <label for="consent" class="text-slate-700">
                            Zgadzam się na kontakt w sprawie zapytania.
                            <span class="text-slate-500">Szczegóły w
                                <a class="underline" href="{{ route('privacy') }}">Polityce prywatności</a>.
                            </span>
                        </label>
                    </div>

                    <button
                        class="w-full inline-flex items-center justify-center gap-2 rounded-lg
                               bg-brand-400 hover:bg-brand-500 text-white font-semibold
                               shadow-glow px-5 py-3">
                        Wyślij
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                        </svg>
                    </button>

                    <p class="text-xs text-slate-500">
                        Wysłanie wiadomości oznacza akceptację
                        <a href="{{ route('privacy') }}" class="underline">Polityki prywatności</a>.
                    </p>
                </form>
            </div>

            <aside class="md:col-span-5 space-y-4">
                <div class="rounded-2xl bg-white shadow-card border border-slate-200/60 p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl grid place-items-center bg-brand-400/15 text-brand-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M2 4l10 7L22 4v14H2z"/></svg>
                        </div>
                        <div>
                            <div class="font-semibold text-brand-900">E-mail</div>
                            <div class="text-sm text-slate-600">Odpowiadamy zwykle w 24h</div>
                        </div>
                    </div>
                    <div class="mt-3 text-brand-700">
                        <a href="mailto:info@finWybor.pl" class="hover:text-brand-500">info@finWybor.pl</a>
                    </div>
                </div>

                <div class="rounded-2xl bg-white shadow-card border border-slate-200/60 p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl grid place-items-center bg-brand-400/15 text-brand-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 119.5 9 2.5 2.5 0 0112 11.5z"/></svg>
                        </div>
                        <div>
                            <div class="font-semibold text-brand-900">Siedziba</div>
                            <div class="text-sm text-slate-600">Warszawa, Polska</div>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-slate-600">
                        Działamy online, nie przyjmujemy klientów na miejscu.
                    </p>
                </div>

                <div class="rounded-2xl bg-white shadow-card border border-slate-200/60 p-5">
                    <div class="font-semibold text-brand-900">Szybkie linki</div>
                    <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                        <a class="inline-flex items-center gap-2 p-2 rounded-lg border border-black/10 hover:bg-slate-50" href="{{ route('faq') }}">
                            <span class="w-5 h-5 grid place-items-center rounded bg-brand-400/15 text-brand-400">?</span> FAQ
                        </a>
                        <a class="inline-flex items-center gap-2 p-2 rounded-lg border border-black/10 hover:bg-slate-50" href="{{ route('terms') }}">
                            <span class="w-5 h-5 grid place-items-center rounded bg-brand-400/15 text-brand-400">§</span> Regulamin
                        </a>
                        <a class="inline-flex items-center gap-2 p-2 rounded-lg border border-black/10 hover:bg-slate-50" href="{{ route('privacy') }}">
                            <span class="w-5 h-5 grid place-items-center rounded bg-brand-400/15 text-brand-400">ⓘ</span> Prywatność
                        </a>
                        <a class="inline-flex items-center gap-2 p-2 rounded-lg border border-black/10 hover:bg-slate-50" href="{{ route('offers.index') }}">
                            <span class="w-5 h-5 grid place-items-center rounded bg-brand-400/15 text-brand-400">→</span> Oferty
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl bg-brand-900 text-white p-5">
                    <div class="text-sm text-white/70">Wskazówka</div>
                    <p class="mt-1 text-sm">
                        Im więcej szczegółów wpiszesz w wiadomości (kwota, okres, typ produktu),
                        tym trafniej będziemy mogli pomóc.
                    </p>
                </div>
            </aside>
        </div>
    </div>
@endsection

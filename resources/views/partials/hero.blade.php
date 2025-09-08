<section class="relative isolate overflow-hidden">
    {{-- Solid dark base for guaranteed contrast --}}
    <div class="absolute inset-0 bg-gradient-to-b from-brand-900 via-brand-900 to-brand-800"></div>

    {{-- Soft accent glows (brand-only colors, low opacity) --}}
    <div class="pointer-events-none absolute -top-32 -left-40 h-[520px] w-[520px] rounded-full
                bg-brand-500/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-40 -right-32 h-[460px] w-[460px] rounded-full
                bg-brand-400/15 blur-3xl"></div>

    {{-- Optional subtle grid, kept very dim so it never overpowers text --}}
    <div class="absolute inset-0 opacity-[.06] mix-blend-overlay bg-grid-faint"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 pt-12 pb-16 md:pt-16 md:pb-20 text-white">
        <div class="max-w-3xl">
            <h1 class="text-3xl md:text-5xl font-bold leading-tight tracking-tight">
                Porównaj pożyczki, karty i ubezpieczenia
                <span class="text-brand-300">w kilka sekund</span>
            </h1>
            <p class="mt-4 text-white/85 text-base md:text-lg">
                Sprawdź RRSO, ratę, całkowity koszt i czas wypłaty. Wybierz najlepiej dopasowaną ofertę – niezależnie i transparentnie.
            </p>
        </div>

        {{-- Finder / wizard --}}
        <form method="get" action="{{ url('/offers') }}"
              class="mt-8 rounded-xl2 border border-white/10 bg-white/5 backdrop-blur
                     shadow-soft p-3 md:p-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-4">
                    <label class="sr-only">Typ</label>
                    <select name="type"
                            class="w-full rounded-lg bg-white/95 text-brand-900 px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-brand-300">
                        <option value="loan">Pożyczki</option>
                        <option value="card">Karty kredytowe</option>
                        <option value="insurance">Ubezpieczenia</option>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="sr-only">Kwota</label>
                    <input type="number" min="100" step="100" name="amount" placeholder="Kwota (PLN)"
                           class="w-full rounded-lg bg-white/95 text-brand-900 px-3 py-2
                                  focus:outline-none focus:ring-2 focus:ring-brand-300">
                </div>
                <div class="md:col-span-3">
                    <label class="sr-only">Okres</label>
                    <input type="number" min="1" max="120" name="term" placeholder="Okres (mies.)"
                           class="w-full rounded-lg bg-white/95 text-brand-900 px-3 py-2
                                  focus:outline-none focus:ring-2 focus:ring-brand-300">
                </div>
                <div class="md:col-span-2">
                    <button
                        class="w-full h-full inline-flex items-center justify-center rounded-lg
                               bg-brand-400 hover:bg-brand-500 text-white font-semibold
                               shadow-glow px-4 py-2">
                        Porównaj
                    </button>
                </div>
            </div>

            {{-- Quick filters --}}
            <div class="mt-3 flex flex-wrap items-center gap-2 text-sm">
                <span class="text-white/70 mr-1">Szybkie filtry:</span>
                <a href="{{ route('offers.index', ['type' => 'loan', 'sort' => 'fastest']) }}"
                   class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/15 border border-white/10">Najszybsza wypłata</a>

                <a href="{{ route('offers.index', ['type' => 'loan', 'sort' => 'cheapest']) }}"
                   class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/15 border border-white/10">Najtaniej</a>

                <a href="{{ route('offers.index', ['type' => 'card']) }}"
                   class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/15 border border-white/10">Karty z okresem bezodsetkowym</a>

                <a href="{{ route('offers.index', ['type' => 'insurance']) }}"
                   class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/15 border border-white/10">OC/AC</a>

            </div>
        </form>

        {{-- Trust bar --}}
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-3 text-xs md:text-sm text-white/85">
            <div class="flex items-center gap-2">
                <span class="inline-flex w-6 h-6 rounded bg-white/10 items-center justify-center">✓</span>
                Niezależne porównanie
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex w-6 h-6 rounded bg-white/10 items-center justify-center">✓</span>
                Transparentne koszty
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex w-6 h-6 rounded bg-white/10 items-center justify-center">✓</span>
                Szybkie decyzje
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex w-6 h-6 rounded bg-white/10 items-center justify-center">✓</span>
                Bez ukrytych opłat
            </div>
        </div>
    </div>
</section>

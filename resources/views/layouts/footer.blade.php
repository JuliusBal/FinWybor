<footer class="mt-12 bg-brand-900 text-white/80">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-sm" role="navigation" aria-label="Stopka">
        <div>
            <a href="{{ url('/') }}" class="font-bold text-white text-lg whitespace-nowrap" translate="no">
                Fin<span class="text-brand-300">Wybor</span>.pl
            </a>

            <p class="mt-3 text-white/70">
                Porównywarka finansowa. Treści mają charakter informacyjny – nie stanowią rekomendacji.
            </p>
        </div>

        <div>
            <div class="font-semibold text-white">Oferta</div>
            <ul class="mt-3 space-y-2">
                <li><a href="{{ route('offers.loans.landing') }}" class="hover:text-white">Pożyczki</a></li>
                <li><a href="{{ route('offers.cards') }}" class="hover:text-white">Karty kredytowe</a></li>
                <li><a href="{{ route('offers.insurance') }}" class="hover:text-white">Ubezpieczenia</a></li>
                <li><a href="{{ route('posts.index') }}" class="hover:text-white">Artykuły</a></li>
            </ul>
        </div>

        <div>
            <div class="font-semibold text-white">Informacje</div>
            <ul class="mt-3 space-y-2">
                <li><a href="{{ route('about') }}" class="hover:text-white">O nas</a></li>
                <li><a href="{{ route('faq') }}" class="hover:text-white">FAQ</a></li>
                <li><a href="{{ route('terms') }}" class="hover:text-white">Regulamin</a></li>
                <li><a href="{{ route('privacy') }}" class="hover:text-white">Polityka prywatności</a></li>
                <li><a href="{{ route('cookies') }}" class="hover:text-white">Pliki cookies</a></li>
                <li><a href="{{ route('newsletter.center') }}" class="hover:text-white">Zarządzaj newsletterem</a></li>
                <li><a href="{{ route('contact.create') }}" class="hover:text-white">Kontakt</a></li>
                <li>
                    <a href="{{ route('cookies') }}" class="hover:text-white"
                       onclick="CookieConsent.open(); return false;">Ustawienia plików cookies</a>
                </li>

            </ul>
        </div>

{{--        <div>--}}
{{--            <div class="font-semibold text-white">Współpraca</div>--}}
{{--            <ul class="mt-3 space-y-2">--}}
{{--                <li>Linki partnerskie (Awin/Admitad/CJ) mogą występować.</li>--}}
{{--                <li>Zawsze porównuj RRSO i całkowity koszt.</li>--}}
{{--            </ul>--}}
{{--        </div>--}}

        <div class="sm:col-span-2 md:col-span-4">
            <div class="inline-flex items-start gap-2 rounded-lg bg-amber-50/10 border border-amber-200/20 px-3 py-2 text-xs text-amber-100">
                <svg class="w-4 h-4 mt-0.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm1 15h-2v-2h2Zm0-4h-2V7h2Z"/></svg>
                <span>Niektóre linki są partnerskie… <span class="font-semibold">Nie wpływa to na cenę ani ranking.</span></span>
            </div>
        </div>

    </div>

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 text-xs text-white/60 flex flex-col md:flex-row items-center justify-between gap-3">
            <div>© {{ date('Y') }} FinWybor.pl</div>
            <div>Transparentność • Prywatność • Bezpieczeństwo</div>
        </div>
    </div>
</footer>

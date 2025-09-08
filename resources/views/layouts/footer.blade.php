<footer class="mt-12 bg-brand-900 text-white/80">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-sm" role="navigation" aria-label="Stopka">
        <div>
            <a href="{{ url('/') }}" class="font-bold text-white text-lg">
                Fin<span class="text-brand-300">Wybor</span>.pl
            </a>
            <p class="mt-3 text-white/70">
                Porównywarka finansowa. Treści mają charakter informacyjny – nie stanowią rekomendacji.
            </p>
        </div>

        <div>
            <div class="font-semibold text-white">Oferta</div>
            <ul class="mt-3 space-y-2">
                <li><a href="{{ route('offers.loans') }}" class="hover:text-white">Pożyczki</a></li>
                <li><a href="{{ route('offers.cards') }}" class="hover:text-white">Karty kredytowe</a></li>
                <li><a href="{{ route('offers.insurance') }}" class="hover:text-white">Ubezpieczenia</a></li>
                <li><a href="{{ route('posts.index') }}" class="hover:text-white">Artykuły</a></li>
            </ul>
        </div>

        <div>
            <div class="font-semibold text-white">Informacje</div>
            <ul class="mt-3 space-y-2">
                <li><a href="{{ route('newsletter.center') }}" class="hover:text-white">Zarządzaj newsletterem</a></li>
                <li><a href="{{ route('faq') }}" class="hover:text-white">FAQ</a></li>
                <li><a href="{{ route('terms') }}" class="hover:text-white">Regulamin</a></li>
                <li><a href="{{ route('privacy') }}" class="hover:text-white">Polityka prywatności</a></li>
                <li><a href="{{ route('contact.create') }}" class="hover:text-white">Kontakt</a></li>
            </ul>
        </div>

        <div>
            <div class="font-semibold text-white">Współpraca</div>
            <ul class="mt-3 space-y-2">
                <li>Linki partnerskie (Awin/Admitad/CJ) mogą występować.</li>
                <li>Zawsze porównuj RRSO i całkowity koszt.</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 text-xs text-white/60 flex flex-col md:flex-row items-center justify-between gap-3">
            <div>© {{ date('Y') }} FinWybor.pl</div>
            <div>Transparentność • Prywatność • Bezpieczeństwo</div>
        </div>
    </div>
</footer>

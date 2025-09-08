@extends('layouts.app')
@include('static._meta_privacy')
@section('content')
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
            <nav class="text-xs text-white/70 mb-3" aria-label="breadcrumbs">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                    <li aria-hidden>›</li>
                    <li class="text-white/90">Polityka prywatności</li>
                </ol>
            </nav>

            <h1 class="text-2xl md:text-4xl font-bold tracking-tight">Polityka prywatności</h1>
            <p class="mt-2 text-white/85 max-w-2xl">
                Informacje o przetwarzaniu danych osobowych oraz zasadach korzystania z plików cookies.
            </p>
        </div>
    </section>

    <div class="max-w-3xl mx-auto px-4 md:px-6 py-10 space-y-6 md:space-y-8">
        <div class="not-prose grid sm:grid-cols-3 gap-3">
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Podstawa</div>
                <div class="mt-1 font-semibold text-brand-900">RODO / GDPR</div>
            </div>
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Rola</div>
                <div class="mt-1 font-semibold text-brand-900">Administrator danych</div>
            </div>
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Kontakt</div>
                <div class="mt-1 font-semibold">
                    <a href="{{ route('contact.create') }}" class="text-brand-600 hover:text-brand-500 underline">Formularz kontaktowy</a>
                </div>
            </div>
        </div>

        <div class="not-prose flex flex-wrap gap-2">
            @php $anchors=[
            ['#admin','Administrator'],
            ['#scope','Zakres danych'],
            ['#purposes','Cele i podstawy'],
            ['#recipients','Odbiorcy'],
            ['#rights','Prawa'],
            ['#cookies','Cookies'],
            ['#retention','Retencja'],
            ['#security','Bezpieczeństwo'],
            ['#xfer','Transfer poza EOG'],
            ['#changes','Zmiany'],
        ]; @endphp
            @foreach($anchors as [$href,$label])
                <a href="{{ $href }}" class="px-3 py-1.5 rounded-lg border border-brand-800/20 bg-brand-800/8 text-sm text-brand-900 hover:bg-brand-800/12">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="prose prose-slate max-w-none prose-p:leading-relaxed">
            <h2 id="admin">1. Administrator danych</h2>
            <p>Administratorem danych jest <strong>FinWybor.pl</strong> („Administrator”). W sprawach prywatności skontaktuj się poprzez
                <a href="{{ route('contact.create') }}">formularz kontaktowy</a>. Dane przetwarzamy z poszanowaniem zasad legalności, minimalizacji, integralności i poufności.</p>

            <h2 id="scope">2. Zakres danych</h2>
            <ul>
                <li><strong>Dane dobrowolnie podane:</strong> imię, e-mail, treść wiadomości w formularzu kontaktowym.</li>
                <li><strong>Dane techniczne:</strong> adres IP, nagłówki przeglądarki, identyfikatory sesji, strefa czasowa, podstawowe informacje o urządzeniu.</li>
                <li><strong>Cookies / podobne technologie:</strong> preferencje, statystyka, bezpieczeństwo, atrybucja afiliacyjna.</li>
                <li><strong>Dane afiliacyjne:</strong> identyfikatory kampanii w linkach partnerskich (bez danych wrażliwych).</li>
            </ul>

            <h2 id="purposes">3. Cele i podstawy prawne</h2>
        </div>

        <div class="not-prose grid gap-3 sm:grid-cols-2">
            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Cel</div>
                <h3 class="mt-1 font-semibold text-brand-900">Obsługa zapytań</h3>
                <p class="mt-1 text-sm text-slate-700">Korespondencja i odpowiedzi.</p>
                <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex px-2 py-1 rounded border border-brand-800/20 bg-brand-800/10 text-[12px] text-brand-800">
                    art. 6 ust. 1 lit. f – uzasadniony interes
                </span>
                </div>
                <div class="mt-3 text-xs text-slate-500">Okres: do zakończenia korespondencji + do 12 mies. archiwizacji technicznej.</div>
            </div>

            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Cel</div>
                <h3 class="mt-1 font-semibold text-brand-900">Analityka serwisu</h3>
                <p class="mt-1 text-sm text-slate-700">Pomiar ruchu i ergonomii.</p>
                <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex px-2 py-1 rounded border border-brand-800/20 bg-brand-800/10 text-[12px] text-brand-800">
                    art. 6 ust. 1 lit. a – zgoda (cookies)
                </span>
                </div>
                <div class="mt-3 text-xs text-slate-500">Okres: do wycofania zgody lub wygaśnięcia cookies.</div>
            </div>

            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Cel</div>
                <h3 class="mt-1 font-semibold text-brand-900">Bezpieczeństwo</h3>
                <p class="mt-1 text-sm text-slate-700">Zapobieganie nadużyciom, ochrona usług.</p>
                <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex px-2 py-1 rounded border border-brand-800/20 bg-brand-800/10 text-[12px] text-brand-800">
                    art. 6 ust. 1 lit. f – uzasadniony interes
                </span>
                </div>
                <div class="mt-3 text-xs text-slate-500">Okres: logi do 12 mies. (dłużej przy incydencie).</div>
            </div>

            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card">
                <div class="text-xs uppercase tracking-wide text-slate-500">Cel</div>
                <h3 class="mt-1 font-semibold text-brand-900">Afiliacja</h3>
                <p class="mt-1 text-sm text-slate-700">Rozliczenia i atrybucja kampanii.</p>
                <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex px-2 py-1 rounded border border-brand-800/20 bg-brand-800/10 text-[12px] text-brand-800">
                    art. 6 ust. 1 lit. f – uzasadniony interes
                </span>
                    <span class="inline-flex px-2 py-1 rounded border border-brand-800/20 bg-brand-800/10 text-[12px] text-brand-800">
                    art. 6 ust. 1 lit. b – wykonanie umowy
                </span>
                </div>
                <div class="mt-3 text-xs text-slate-500">Okres: zgodnie z umową i terminami przedawnienia.</div>
            </div>

            <div class="rounded-xl border border-black/10 bg-white p-4 shadow-card sm:col-span-2">
                <div class="text-xs uppercase tracking-wide text-slate-500">Cel</div>
                <h3 class="mt-1 font-semibold text-brand-900">Obowiązki prawne</h3>
                <p class="mt-1 text-sm text-slate-700">Rachunkowość, obsługa skarg.</p>
                <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex px-2 py-1 rounded border border-brand-800/20 bg-brand-800/10 text-[12px] text-brand-800">
                    art. 6 ust. 1 lit. c – obowiązek prawny
                </span>
                </div>
                <div class="mt-3 text-xs text-slate-500">Okres: przez czas wymagany przepisami.</div>
            </div>
        </div>

        <div class="prose prose-slate max-w-none prose-p:leading-relaxed">
            <h2 id="recipients">4. Odbiorcy danych</h2>
            <p>Dane udostępniamy wyłącznie podmiotom przetwarzającym w naszym imieniu i na podstawie umów powierzenia, m.in.:</p>
            <ul>
                <li>dostawcy hostingu i infrastruktury,</li>
                <li>dostawcy analityki (w formie zanonimizowanych/zbiorczych statystyk),</li>
                <li>sieci afiliacyjne (np. Awin) – w zakresie identyfikatorów kampanii,</li>
                <li>doradcy prawni/księgowi – gdy jest to konieczne.</li>
            </ul>

            <h2 id="rights">5. Twoje prawa</h2>
            <p>Masz prawo do: dostępu do danych i kopii, sprostowania, usunięcia („bycia zapomnianym”), ograniczenia, sprzeciwu (gdy podstawą jest uzasadniony interes), przenoszenia danych oraz złożenia skargi do Prezesa UODO. Żądania realizujemy bez zbędnej zwłoki; w celu weryfikacji tożsamości możemy poprosić o dodatkowe informacje.</p>

            <h2 id="cookies">6. Cookies i podobne technologie</h2>
            <p>Wykorzystujemy cookies do zapewnienia działania serwisu, bezpieczeństwa oraz statystyk. Ustawienia możesz zmienić w przeglądarce. Kategorie:</p>
            <ul>
                <li><strong>Niezbędne</strong> – wymagane do działania (nie podlegają zgodzie),</li>
                <li><strong>Analityczne</strong> – pomiar ruchu i ergonomii (wymaga zgody),</li>
                <li><strong>Afiliacyjne</strong> – atrybucja kampanii (wymaga zgody, jeśli stosowane).</li>
            </ul>
            <p class="text-sm text-slate-600">W każdej chwili możesz cofnąć zgodę – wpływa to na przyszłe przetwarzanie.</p>

            <h2 id="retention">7. Okres przechowywania</h2>
            <p>Przechowujemy dane tak długo, jak to konieczne do realizacji celu lub do wycofania zgody, a także przez okres niezbędny do ustalenia, dochodzenia lub obrony roszczeń oraz rozliczeń ustawowych.</p>

            <h2 id="security">8. Bezpieczeństwo</h2>
            <p>Stosujemy adekwatne środki techniczne i organizacyjne: szyfrowanie w tranzycie (HTTPS), kontrola dostępu, minimalizacja zakresu danych, aktualizacje środowiska i regularne przeglądy konfiguracji.</p>

            <h2 id="xfer">9. Przekazywanie danych poza EOG</h2>
            <p>Dane mogą być przekazane poza EOG wyłącznie przy zapewnieniu odpowiednich zabezpieczeń prawnych (np. standardowe klauzule umowne, dodatkowe środki techniczne/organizacyjne) i tylko, gdy to konieczne do świadczenia usług.</p>

            <h2 id="changes">10. Zmiany polityki</h2>
            <p>Polityka może się zmieniać wraz z rozwojem serwisu i przepisów. Data ostatniej aktualizacji: <strong>{{ now()->format('Y-m-d') }}</strong>.</p>
        </div>

        <div class="not-prose rounded-xl border border-brand-800/20 bg-brand-800/5 p-4">
            <div class="text-sm font-semibold text-brand-900">Transparentność</div>
            <p class="text-sm text-slate-700 mt-1">
                Masz pytania o zakres, podstawy lub okresy? Napisz do nas przez formularz – zwykle odpowiadamy w 24 godziny.
            </p>
        </div>
    </div>

@endsection

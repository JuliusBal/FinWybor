@extends('layouts.app')
@include('static._meta_terms')
@section('content')
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
            <nav class="text-xs text-white/70 mb-3" aria-label="breadcrumbs">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                    <li aria-hidden>›</li>
                    <li class="text-white/90">Regulamin</li>
                </ol>
            </nav>

            <h1 class="text-2xl md:text-4xl font-bold tracking-tight">Regulamin</h1>
            <p class="mt-2 text-white/85 max-w-2xl">
                Zasady korzystania z serwisu FinWybor.pl.
            </p>
        </div>
    </section>
    <div class="max-w-3xl mx-auto px-4 md:px-6 py-10 space-y-6">
        <div class="not-prose grid sm:grid-cols-3 gap-3">
            <div class="rounded-xl border border-black/10 bg-white p-4">
                <div class="text-xs uppercase tracking-wide text-slate-500">Podstawa prawna</div>
                <div class="mt-1 font-semibold text-brand-900">RODO / GDPR</div>
            </div>
            <div class="rounded-xl border border-black/10 bg-white p-4">
                <div class="text-xs uppercase tracking-wide text-slate-500">Rola</div>
                <div class="mt-1 font-semibold text-brand-900">Administrator danych</div>
            </div>
            <div class="rounded-xl border border-black/10 bg-white p-4">
                <div class="text-xs uppercase tracking-wide text-slate-500">Kontakt</div>
                <div class="mt-1 font-semibold text-brand-900">
                    <a href="{{ route('contact.create') }}" class="text-brand-600 hover:text-brand-500 underline">Formularz kontaktowy</a>
                </div>
            </div>
        </div>

        <div class="prose prose-slate max-w-none">
            <h2 id="administrator">1. Administrator danych</h2>
            <p>Administratorem danych jest <strong>FinWybor.pl</strong> („Administrator”). W sprawach prywatności skontaktuj się przez
                <a href="{{ route('contact.create') }}">formularz kontaktowy</a>.</p>

            <h2 id="zakres">2. Jakie dane przetwarzamy</h2>
            <ul>
                <li><strong>Dane podane dobrowolnie</strong> – np. imię, e-mail, treść wiadomości przesłana przez formularz.</li>
                <li><strong>Dane techniczne</strong> – adres IP, nagłówki przeglądarki, znacznik czasu, podstawowe dane o urządzeniu.</li>
                <li><strong>Cookies / podobne technologie</strong> – statystyka, bezpieczeństwo, ustawienia serwisu.</li>
                <li><strong>Dane afiliacyjne</strong> – identyfikatory kampanii w linkach partnerskich (bez danych wrażliwych).</li>
            </ul>

            <h2 id="cele">3. Cele, podstawa prawna i okresy</h2>
        </div>

        <div class="max-w-3xl mx-auto px-4 md:px-6 py-10 space-y-6 md:space-y-8">
            <div class="not-prose grid sm:grid-cols-3 gap-3">
                <div class="rounded-xl border border-black/10 bg-white p-4">
                    <div class="text-xs uppercase tracking-wide text-slate-500">Charakter serwisu</div>
                    <div class="mt-1 font-semibold text-brand-900">Porównywarka / informacyjny</div>
                </div>
                <div class="rounded-xl border border-black/10 bg-white p-4">
                    <div class="text-xs uppercase tracking-wide text-slate-500">Usługi finansowe</div>
                    <div class="mt-1 font-semibold text-brand-900">Nie udzielamy pożyczek</div>
                </div>
                <div class="rounded-xl border border-black/10 bg-white p-4">
                    <div class="text-xs uppercase tracking-wide text-slate-500">Kontakt</div>
                    <div class="mt-1 font-semibold text-brand-900">
                        <a href="{{ route('contact.create') }}" class="text-brand-600 hover:text-brand-500 underline">Formularz kontaktowy</a>
                    </div>
                </div>
            </div>

            <div class="prose prose-slate max-w-none prose-p:leading-relaxed">
                <h2 id="postanowienia">1. Postanowienia ogólne</h2>
                <p>FinWybor.pl („Serwis”) jest porównywarką produktów finansowych i ma charakter informacyjny. Korzystając z Serwisu, akceptujesz niniejszy Regulamin.</p>

                <h2 id="definicje">2. Definicje</h2>
                <ul>
                    <li><strong>Użytkownik</strong> – osoba korzystająca z Serwisu.</li>
                    <li><strong>Dostawca</strong> – zewnętrzny podmiot oferujący produkt/usługę finansową.</li>
                    <li><strong>Link partnerski</strong> – odnośnik, którego kliknięcie może skutkować rozliczeniem prowizyjnym między Serwisem a partnerem.</li>
                </ul>

                <h2 id="zakres">3. Zakres i zasady korzystania</h2>
                <ul>
                    <li>Serwis nie udziela pożyczek ani nie pośredniczy w zawieraniu umów – prezentuje informacje, rankingi i linki do Dostawców.</li>
                    <li>Dane o ofertach mają charakter poglądowy; szczegółowe warunki i koszty określa Dostawca.</li>
                    <li>Minimalny wiek Użytkownika: <strong>18 lat</strong>.</li>
                    <li>Zakazane jest dostarczanie treści bezprawnych oraz działania zakłócające działanie Serwisu.</li>
                </ul>

                <h2 id="informacje">4. Informacje handlowe i afiliacja</h2>
                <ul>
                    <li>Serwis może używać <code>linków partnerskich</code>. Prowizja dla wydawcy <strong>nie wpływa</strong> na cenę dla Użytkownika.</li>
                    <li>Oznaczamy treści sponsorowane/partnerskie w sposób zrozumiały.</li>
                    <li>Kolejność wyników zależy od wybranych kryteriów (np. najtaniej, najszybciej, alfabetycznie) lub może uwzględniać ręczną selekcję redakcyjną – zgodnie z opisem przy danym rankingu.</li>
                </ul>

                <h2 id="odpowiedzialnosc">5. Odpowiedzialność i zastrzeżenia</h2>
                <ul>
                    <li>Dokładamy starań, aby informacje były aktualne, jednak nie gwarantujemy ich pełnej poprawności i kompletności.</li>
                    <li>Serwis nie świadczy doradztwa finansowego, prawnego ani podatkowego. Materiały nie stanowią rekomendacji.</li>
                    <li>Serwis nie odpowiada za decyzje Użytkownika ani za działanie stron Dostawców.</li>
                    <li>W przypadku prac technicznych lub błędów Serwis może być chwilowo niedostępny.</li>
                </ul>

                <h2 id="prawa-autorskie">6. Prawa autorskie</h2>
                <p>Wszelkie treści Serwisu są chronione prawem autorskim. Zabronione jest kopiowanie lub rozpowszechnianie bez zgody, z wyjątkiem dozwolonego użytku.</p>

                <h2 id="reklamacje">7. Reklamacje</h2>
                <p>Uwagi dot. działania Serwisu możesz zgłosić poprzez <a href="{{ route('contact.create') }}">formularz kontaktowy</a>. Reklamacje rozpatrujemy w rozsądnym terminie (zwykle do 14 dni). W sprawach dotyczących umów z Dostawcą skontaktuj się bezpośrednio z Dostawcą.</p>

                <h2 id="linki-zewnetrzne">8. Linki zewnętrzne</h2>
                <p>Odsyłacze prowadzą do serwisów zewnętrznych pozostających poza naszą kontrolą. Nie odpowiadamy za ich działanie ani treści.</p>

                <h2 id="zmiany">9. Zmiany Regulaminu</h2>
                <p>Regulamin może być aktualizowany. O zmianach poinformujemy poprzez publikację nowej wersji w Serwisie z podaniem daty. Data ostatniej aktualizacji: <strong>{{ now()->format('Y-m-d') }}</strong>.</p>

                <h2 id="prawo">10. Prawo właściwe i jurysdykcja</h2>
                <p>Do Regulaminu stosuje się prawo polskie. Właściwym sądem jest sąd powszechny miejscowo właściwy według przepisów prawa, z poszanowaniem praw konsumenta.</p>

                <h2 id="kontakt">11. Kontakt</h2>
                <p>W sprawach dotyczących Serwisu skontaktuj się przez <a href="{{ route('contact.create') }}">formularz kontaktowy</a>.</p>
            </div>

            <div class="not-prose rounded-xl border border-brand-800/20 bg-brand-800/5 p-4">
                <div class="text-sm font-semibold text-brand-900">Uwaga</div>
                <p class="text-sm text-slate-700 mt-1">
                    Informacje w Serwisie mają charakter poglądowy i nie zastępują dokumentów ofertowych Dostawcy ani indywidualnej oceny sytuacji.
                </p>
            </div>
        </div>

        <div class="prose prose-slate max-w-none prose-headings:mt-8 prose-p:leading-relaxed">
            <h2 id="odbiorcy">4. Odbiorcy danych</h2>
            <p>Udostępniamy dane wyłącznie podmiotom przetwarzającym w naszym imieniu, m.in.:</p>
            <ul>
                <li>dostawcy hostingu i infrastruktury,</li>
                <li>dostawcy analityki (agregowane statystyki),</li>
                <li>sieci afiliacyjne (np. Awin) w zakresie identyfikatorów kampanii,</li>
                <li>podmioty doradcze i prawne – jeśli to konieczne.</li>
            </ul>
            <p>Dane mogą być przekazywane poza EOG wyłącznie przy zapewnieniu odpowiednich mechanizmów (np. standardowe klauzule umowne).</p>

            <h2 id="prawa">5. Twoje prawa</h2>
            <ul class="leading-relaxed">
                <li>dostęp do danych i kopia danych,</li>
                <li>sprostowanie,</li>
                <li>usunięcie („prawo do bycia zapomnianym”),</li>
                <li>ograniczenie przetwarzania,</li>
                <li>sprzeciw (gdy podstawą jest uzasadniony interes),</li>
                <li>przenoszenie danych,</li>
                <li>skarga do Prezesa UODO.</li>
            </ul>
            <p>Żądania realizujemy bez zbędnej zwłoki. W celu weryfikacji możemy poprosić o dodatkowe informacje potwierdzające tożsamość.</p>

            <h2 id="cookies">6. Cookies i podobne technologie</h2>
            <p>Serwis wykorzystuje pliki cookies do działania, bezpieczeństwa oraz statystyk. Ustawienia możesz zmienić w przeglądarce. Kategorie:</p>
            <ul>
                <li><strong>Niezbędne</strong> – wymagane do działania serwisu (bez zgody),</li>
                <li><strong>Analityczne</strong> – pomiar ruchu i ergonomii (wymaga zgody),</li>
                <li><strong>Afiliacyjne</strong> – atrybucja kampanii (wymaga zgody, gdy stosowane).</li>
            </ul>

            <h2 id="retencja">7. Okres przechowywania</h2>
            <p>Przechowujemy dane tak długo, jak to konieczne do realizacji celu, do wycofania zgody, oraz przez czas potrzebny do ustalenia, dochodzenia lub obrony roszczeń.</p>

            <h2 id="bezpieczenstwo">8. Bezpieczeństwo</h2>
            <p>Stosujemy środki techniczne i organizacyjne: szyfrowanie w tranzycie, kontrolę dostępu, minimalizację danych, regularne przeglądy konfiguracji.</p>

            <h2 id="nieletni">9. Użytkownicy niepełnoletni</h2>
            <p>Serwis jest przeznaczony dla osób pełnoletnich. Jeśli dziecko przekazało nam dane – skontaktuj się, usuniemy je niezwłocznie.</p>

            <h2 id="zmiany">10. Zmiany polityki</h2>
            <p>Polityka może być aktualizowana. Data ostatniej aktualizacji: <strong>{{ now()->format('Y-m-d') }}</strong>.</p>
        </div>

        <div class="not-prose mt-6 rounded-xl border border-brand-800/20 bg-brand-800/5 p-4">
            <div class="text-sm font-semibold text-brand-900">Transparentność</div>
            <p class="text-sm text-slate-700 mt-1">
                Masz pytania o zakres lub podstawy przetwarzania? Napisz do nas – zwykle odpowiadamy w 24 godziny.
            </p>
        </div>
@endsection

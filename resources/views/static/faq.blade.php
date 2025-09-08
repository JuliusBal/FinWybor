@extends('layouts.app')
@include('static._meta_faq')

@section('content')
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
            <nav class="text-xs text-white/70 mb-3" aria-label="breadcrumbs">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ url('/') }}" class="hover:text-white/90">Start</a></li>
                    <li aria-hidden>›</li>
                    <li class="text-white/90">FAQ</li>
                </ol>
            </nav>

            <h1 class="text-2xl md:text-4xl font-bold tracking-tight">FAQ – Najczęstsze pytania</h1>
            <p class="mt-2 text-white/85 max-w-2xl">
                Odpowiadamy na najczęstsze pytania dotyczące pożyczek, kart kredytowych i ubezpieczeń.
            </p>
        </div>
    </section>
    <div class="max-w-3xl mx-auto px-4 md:px-6 py-10">
        <div class="not-prose mb-6 rounded-xl border border-black/10 bg-white shadow-card p-4">
            <div class="text-sm font-semibold text-brand-900">Najczęściej pytacie o:</div>
            <div class="mt-2 flex flex-wrap gap-2 text-sm">
                <a href="#czy-udzielacie-pozyczek" class="px-3 py-1.5 rounded-lg bg-brand-400/10 text-brand-900 border border-brand-400/20 hover:bg-brand-400/15">Czy udzielacie pożyczek?</a>
                <a href="#rrso" class="px-3 py-1.5 rounded-lg bg-brand-400/10 text-brand-900 border border-brand-400/20 hover:bg-brand-400/15">RRSO</a>
                <a href="#czas-wyplaty" class="px-3 py-1.5 rounded-lg bg-brand-400/10 text-brand-900 border border-brand-400/20 hover:bg-brand-400/15">Czas wypłaty</a>
                <a href="#bik" class="px-3 py-1.5 rounded-lg bg-brand-400/10 text-brand-900 border border-brand-400/20 hover:bg-brand-400/15">BIK</a>
                <a href="#wczesniejsza-splata" class="px-3 py-1.5 rounded-lg bg-brand-400/10 text-brand-900 border border-brand-400/20 hover:bg-brand-400/15">Wcześniejsza spłata</a>
                <a href="#jak-zarabiacie" class="px-3 py-1.5 rounded-lg bg-brand-400/10 text-brand-900 border border-brand-400/20 hover:bg-brand-400/15">Linki partnerskie</a>
            </div>
        </div>

        <div class="prose prose-slate max-w-none">
            <h2 id="czy-udzielacie-pozyczek">Czy FinWybor.pl udziela pożyczek?</h2>
            <p><strong>Nie.</strong> Jesteśmy porównywarką. Prezentujemy informacje o ofertach i kierujemy do zewnętrznych dostawców, u których składasz wniosek.</p>

            <h2 id="rrso">Czym jest RRSO?</h2>
            <p><abbr title="Rzeczywista Roczna Stopa Oprocentowania">RRSO</abbr> pokazuje <em>całkowity</em> koszt finansowania w ujęciu rocznym (odsetki, prowizje, opłaty). Dzięki temu łatwiej porównać oferty między sobą.</p>

            <div class="not-prose my-4 p-4 rounded-xl bg-brand-900 text-white">
                <div class="text-sm font-semibold">Wskazówka</div>
                <p class="text-sm mt-1 opacity-90">Niższe RRSO zwykle = tańszy kredyt/pożyczka, ale zwróć uwagę też na <span class="underline decoration-white/40">całkowity koszt</span> oraz warunki wcześniejszej spłaty.</p>
            </div>

            <h2 id="czas-wyplaty">Jak długo trwa wypłata środków?</h2>
            <p>To zależy od dostawcy i banku. W ofertach oznaczamy orientacyjny czas: <span class="whitespace-nowrap">„Natychmiast”</span>, „Dziś” albo „1–3 dni”. Rzeczywisty czas może się różnić (np. weryfikacja tożsamości, godziny księgowań).</p>

            <h2 id="bik">Czy sprawdzacie BIK / czy wniosek wpływa na zdolność?</h2>
            <p>My nie sprawdzamy BIK. Niektórzy dostawcy mogą weryfikować bazy (BIK, BIG, KRD). Samo przejrzenie ofert u nas nie wpływa na zdolność. <strong>Twarde zapytanie kredytowe</strong> może wykonać dopiero pożyczkodawca przy składaniu wniosku.</p>

            <h2 id="wczesniejsza-splata">Czy można spłacić wcześniej?</h2>
            <p>W większości ofert tak. Wcześniejsza spłata zwykle obniża całkowity koszt. Sprawdź warunki w Tabeli Opłat lub umowie – czasem naliczana jest proporcjonalna część opłat.</p>

            <h2 id="czy-to-jest-darmowe">Czy korzystanie z porównywarki jest darmowe?</h2>
            <p>Tak. Przeglądanie i filtrowanie ofert jest bezpłatne dla użytkowników.</p>

            <h2 id="jak-zarabiacie">Czy linki partnerskie wpływają na cenę? Jak zarabiacie?</h2>
            <p>W części materiałów używamy <code>linków partnerskich</code>. Jeśli złożysz wniosek, możemy otrzymać prowizję od partnera. <strong>Nie wpływa</strong> to na cenę po stronie użytkownika ani kolejność wyników oznaczonych parametrem sortowania.</p>

            <h2 id="ranking-i-sortowanie">Jak działa ranking i sortowanie?</h2>
            <p>Możesz sortować m.in. po: <strong>najszybszej wypłacie</strong>, <strong>najniższej nadpłacie</strong> lub <strong>alfabetycznie</strong>. Kryteria widzisz w pasku filtrów nad listą ofert.</p>

            <h2 id="ratalna-vs-chwilowka">Pożyczka ratalna czy „chwilówka” – czym się różnią?</h2>
            <ul>
                <li><strong>Ratalna:</strong> dłuższy okres, stała rata, zwykle niższe RRSO.</li>
                <li><strong>Chwilówka:</strong> krótki okres (np. 30 dni), często wyższe koszty, czasem promocje „0%” dla nowych klientów.</li>
            </ul>

            <h2 id="dokladnosc-wyliczen">Czy kwoty (rata, całkowity koszt) są dokładne?</h2>
            <p>To <em>symulacje</em> dla zadanych parametrów (kwota, okres). Dokładne warunki i koszty poznasz po złożeniu wniosku u wybranego dostawcy.</p>

            <h2 id="brak-ofert">Nie widzę ofert dla moich parametrów – co zrobić?</h2>
            <p>Spróbuj zmienić parametry (kwota/okres) lub sortowanie. Możesz też przejrzeć inne kategorie (np. karty, ubezpieczenia) i wrócić do pożyczek.</p>

            <h2 id="bezpieczenstwo">Jak dbacie o prywatność i bezpieczeństwo?</h2>
            <p>Stosujemy dobre praktyki bezpieczeństwa, a dane przetwarzamy zgodnie z <a href="{{ route('privacy') }}">Polityką prywatności</a>. Formularz kontaktowy służy wyłącznie do obsługi zapytań.</p>

            <h2 id="kontakt">Chcę dopytać o szczegóły – jak się skontaktować?</h2>
            <p>Napisz do nas przez <a href="{{ route('contact.create') }}">formularz kontaktowy</a>. Zwykle odpowiadamy w 24h.</p>
        </div>

        <div class="not-prose mt-8 text-xs text-slate-500">
            Informacje nie stanowią rekomendacji ani porady finansowej. Przed podjęciem decyzji zapoznaj się z dokumentami ofertowymi dostawcy.
        </div>
    </div>

    @push('scripts')
        @verbatim
            <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": [
                    {
                      "@type": "Question",
                      "name": "Czy FinWybor.pl udziela pożyczek?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Nie. Jesteśmy porównywarką – prezentujemy informacje o ofertach i kierujemy do zewnętrznych dostawców."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Czym jest RRSO?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "RRSO (Rzeczywista Roczna Stopa Oprocentowania) to wskaźnik całkowitego kosztu finansowania w ujęciu rocznym, ułatwiający porównanie ofert."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Jak długo trwa wypłata środków?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Zależy od dostawcy i banku. Oznaczamy orientacyjnie: Natychmiast, Dziś albo 1–3 dni. Rzeczywisty czas może się różnić (np. weryfikacja tożsamości)."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Czy sprawdzacie BIK / czy wniosek wpływa na zdolność?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "My nie sprawdzamy BIK. Część dostawców może weryfikować bazy (BIK, BIG, KRD). Samo przeglądanie ofert nie wpływa na zdolność; twarde zapytanie może wykonać pożyczkodawca przy wniosku."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Czy można spłacić pożyczkę wcześniej?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Najczęściej tak. Wcześniejsza spłata zwykle zmniejsza całkowity koszt. Szczegóły znajdziesz w Tabeli Opłat lub umowie (czasem naliczana jest proporcjonalna część opłat)."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Czy korzystanie z porównywarki jest darmowe?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Tak. Korzystanie z porównywarki i filtrowanie ofert jest bezpłatne dla użytkowników."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Czy linki partnerskie wpływają na cenę? Jak zarabiacie?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Używamy linków partnerskich. Jeśli złożysz wniosek, możemy otrzymać prowizję. Nie wpływa to na cenę ani wyniki sortowania ustawione przez użytkownika."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Jak działa ranking i sortowanie?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Możesz sortować po czasie wypłaty, najniższej nadpłacie lub alfabetycznie. Kryteria widoczne są w pasku filtrów nad listą ofert."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Pożyczka ratalna a chwilówka – różnice?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Pożyczka ratalna: dłuższy okres, stała rata, zwykle niższe RRSO. Chwilówka: krótki okres (np. 30 dni), często wyższe koszty, czasem promocje 0% dla nowych klientów."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Czy prezentowane kwoty są dokładne?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "To symulacje dla zadanych parametrów (kwota, okres). Dokładne warunki i koszty poznasz po złożeniu wniosku u dostawcy."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Co zrobić, jeśli nie widzę ofert dla moich parametrów?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Zmień parametry (kwota/okres) lub sortowanie, sprawdź inne kategorie i wróć do pożyczek. Oferty zmieniają się w czasie."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Jak dbacie o prywatność i bezpieczeństwo?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Stosujemy dobre praktyki bezpieczeństwa i przetwarzamy dane zgodnie z Polityką prywatności. Formularz kontaktowy służy wyłącznie do obsługi zapytań."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Jak się skontaktować?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Skorzystaj z formularza kontaktowego – zwykle odpowiadamy w 24 godziny."
                      }
                    }
                  ]
                }
            </script>
        @endverbatim
    @endpush
@endsection

@php
    $title     = 'FAQ – Najczęstsze pytania | FinWybor.pl';
    $desc      = 'Odpowiadamy na najczęstsze pytania dotyczące pożyczek, kart i ubezpieczeń.';
    $canonical = route('faq');
    $faq = [
        [
          'q' => 'Czy FinWybor.pl udziela pożyczek?',
          'a' => 'Nie. Jesteśmy porównywarką – prezentujemy informacje o ofertach i kierujemy do zewnętrznych dostawców.'
        ],
        [
          'q' => 'Czym jest RRSO?',
          'a' => 'RRSO (Rzeczywista Roczna Stopa Oprocentowania) to wskaźnik całkowitego kosztu finansowania w ujęciu rocznym, ułatwiający porównanie ofert.'
        ],
        [
          'q' => 'Jak długo trwa wypłata środków?',
          'a' => 'Zależy od dostawcy i banku. Oznaczamy orientacyjnie: Natychmiast, Dziś albo 1–3 dni. Rzeczywisty czas może się różnić (np. weryfikacja tożsamości).'
        ],
        [
          'q' => 'Czy sprawdzacie BIK / czy wniosek wpływa na zdolność?',
          'a' => 'My nie sprawdzamy BIK. Część dostawców może weryfikować bazy (BIK, BIG, KRD). Samo przeglądanie ofert nie wpływa na zdolność; twarde zapytanie może wykonać pożyczkodawca przy wniosku.'
        ],
        [
          'q' => 'Czy można spłacić pożyczkę wcześniej?',
          'a' => 'Najczęściej tak. Wcześniejsza spłata zwykle zmniejsza całkowity koszt. Szczegóły znajdziesz w Tabeli Opłat lub umowie (czasem naliczana jest proporcjonalna część opłat).'
        ],
        [
          'q' => 'Czy korzystanie z porównywarki jest darmowe?',
          'a' => 'Tak. Korzystanie z porównywarki i filtrowanie ofert jest bezpłatne dla użytkowników.'
        ],
        [
          'q' => 'Czy linki partnerskie wpływają na cenę? Jak zarabiacie?',
          'a' => 'Używamy linków partnerskich. Jeśli złożysz wniosek, możemy otrzymać prowizję. Nie wpływa to na cenę ani wyniki sortowania ustawione przez użytkownika.'
        ],
        [
          'q' => 'Jak działa ranking i sortowanie?',
          'a' => 'Możesz sortować po czasie wypłaty, najniższej nadpłacie lub alfabetycznie. Kryteria widoczne są w pasku filtrów nad listą ofert.'
        ],
        [
          'q' => 'Pożyczka ratalna a chwilówka – różnice?',
          'a' => 'Pożyczka ratalna: dłuższy okres, stała rata, zwykle niższe RRSO. Chwilówka: krótki okres (np. 30 dni), często wyższe koszty, czasem promocje 0% dla nowych klientów.'
        ],
        [
          'q' => 'Czy prezentowane kwoty są dokładne?',
          'a' => 'To symulacje dla zadanych parametrów (kwota, okres). Dokładne warunki i koszty poznasz po złożeniu wniosku u dostawcy.'
        ],
        [
          'q' => 'Co zrobić, jeśli nie widzę ofert dla moich parametrów?',
          'a' => 'Zmień parametry (kwota/okres) lub sortowanie, sprawdź inne kategorie i wróć do pożyczek. Oferty zmieniają się w czasie.'
        ],
        [
          'q' => 'Jak dbacie o prywatność i bezpieczeństwo?',
          'a' => 'Stosujemy dobre praktyki bezpieczeństwa i przetwarzamy dane zgodnie z Polityką prywatności. Formularz kontaktowy służy wyłącznie do obsługi zapytań.'
        ],
        [
          'q' => 'Jak się skontaktować?',
          'a' => 'Skorzystaj z formularza kontaktowego – zwykle odpowiadamy w 24 godziny.'
        ],
    ];

    $faqLd = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'name'       => 'FAQ – Najczęstsze pytania',
        'url'        => $canonical,
        'inLanguage' => 'pl-PL',
        'mainEntity' => collect($faq)->map(fn($i) => [
            '@type' => 'Question',
            'name'  => $i['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $i['a'],
            ],
        ])->values(),
    ];
@endphp

@section('title', $title)
@section('meta_description', $desc)
@section('canonical', $canonical)
@section('og_title', $title)
@section('og_description', $desc)

@once
    @push('meta')
        <script type="application/ld+json">
            {!! json_encode($faqLd, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>

        <script type="application/ld+json">
            {!! json_encode([
              '@context' => 'https://schema.org',
              '@type'    => 'BreadcrumbList',
              'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Start','item'=>url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>'FAQ','item'=>$canonical],
              ],
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endpush
@endonce

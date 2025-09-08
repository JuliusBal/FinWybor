@php
    use Illuminate\Support\Str;

    $humanType = [
        'loan'      => 'pożyczki',
        'card'      => 'karty kredytowe',
        'insurance' => 'ubezpieczenia',
    ][$type] ?? 'oferty';

    $title = $title
        ?? "Porównaj {$humanType} — {$amount} PLN / {$term} mies. | FinWybor.pl";

    $desc = $desc
        ?? Str::limit("Zestawienie: {$humanType} dla {$amount} zł na {$term} mies. Zobacz RRSO, ratę, całkowity koszt i czas wypłaty.", 155);

    $canonParams = $canonParams
        ?? array_filter([
            'type'   => $type,
            'amount' => $amount,
            'term'   => $term,
            'sort'   => ($sort ?? 'brand') !== 'brand' ? $sort : null,
        ], fn($v) => $v !== null && $v !== '');

    $canonical = $canonical
        ?? route('offers.index', $canonParams);

    $robots = $robots
        ?? (request()->filled('q') ? 'noindex,follow' : 'index,follow');
@endphp

@section('title', $title)
@section('meta_description', $desc)
@section('canonical', $canonical)
@section('meta_robots', $robots)
@section('og_title', $title)
@section('og_description', $desc)

@push('meta')
    @php
        $breadcrumbsLd = [
            '@context' => 'https://schema.org',
            '@type'    => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Start',
                    'item'     => url('/'),
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Porównanie ofert',
                    'item'     => $canonical,
                ],
            ],
        ];

        $itemListLd = null;
        if (!empty($offers) && count($offers)) {
            $elements = collect($offers)->take(20)->values()->map(function ($o, $i) use ($canonical) {
                return [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'name'     => $o->brand,
                    'url'      => $canonical . '#offer-' . $o->id,
                ];
            })->all();

            $itemListLd = [
                '@context'         => 'https://schema.org',
                '@type'            => 'ItemList',
                'itemListElement'  => $elements,
            ];
        }
    @endphp

    <script type="application/ld+json">
        {!! json_encode($breadcrumbsLd, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
    </script>

    @if($itemListLd)
        <script type="application/ld+json">
            {!! json_encode($itemListLd, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endif
@endpush

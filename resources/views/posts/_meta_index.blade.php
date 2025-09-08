@php
    use Illuminate\Support\Str;

    $baseTitle = 'Blog finansowy — FinWybor.pl';
    $catName   = $catSlug ? optional($categories->firstWhere('slug', $catSlug))->name : null;

    if ($catName) {
        $title = "Kategoria: {$catName} — {$baseTitle}";
        $desc  = "Artykuły w kategorii „{$catName}”: pożyczki, karty i ubezpieczenia. Praktyczne poradniki i porównania.";
    } elseif (!empty($q ?? '')) {
        $title = "Wyniki dla „{$q}” — {$baseTitle}";
        $desc  = "Wyniki wyszukiwania dla „{$q}” w blogu finansowym: poradniki, porównania i analizy.";
    } else {
        $title = $baseTitle;
        $desc  = 'Artykuły i poradniki: pożyczki, karty kredytowe, ubezpieczenia.';
    }

    $desc  = Str::limit($desc, 155);
    $page  = ($posts instanceof \Illuminate\Contracts\Pagination\Paginator) ? $posts->currentPage() : 1;

    $canonParams = array_filter([
        'category' => $catSlug,
        'sort'     => ($sort ?? 'newest') !== 'newest' ? $sort : null,
        'page'     => $page > 1 ? $page : null,
    ], fn($v) => !is_null($v) && $v !== '');

    $canonical = $canonParams ? route('posts.index', $canonParams) : route('posts.index');
    $robots    = !empty($q ?? '') ? 'noindex,follow' : 'index,follow';
@endphp

@section('title', $title)
@section('meta_description', $desc)
@section('canonical', $canonical)
@section('meta_robots', $robots)
@section('og_title', $title)
@section('og_description', $desc)

@once
    @push('meta')
        @if($posts instanceof \Illuminate\Contracts\Pagination\Paginator)
            @if($posts->previousPageUrl())
                <link rel="prev" href="{{ canonical_url(null, ['page' => $posts->currentPage() - 1]) }}">
            @endif
            @if($posts->hasMorePages())
                <link rel="next" href="{{ canonical_url(null, ['page' => $posts->currentPage() + 1]) }}">
            @endif
        @endif
    @endpush
@endonce

@once
    @push('meta')
        @php
            $crumbs = [
                ["@type"=>"ListItem","position"=>1,"name"=>"Start","item"=>url('/')],
                ["@type"=>"ListItem","position"=>2,"name"=>"Blog","item"=>route('posts.index')],
            ];
            if (!empty($catName)) {
                $crumbs[] = ["@type"=>"ListItem","position"=>3,"name"=>$catName,"item"=>$canonical];
            }

            $breadcrumbsSchema = [
                "@context" => "https://schema.org",
                "@type"    => "BreadcrumbList",
                "itemListElement" => $crumbs,
            ];

            $itemListSchema = null;
            if ($posts->count()) {
                $items = [];
                $i = 1;
                foreach ($posts->take(20) as $p) {
                    $items[] = [
                        "@type"    => "ListItem",
                        "position" => $i++,
                        "url"      => route('posts.show', $p->slug),
                        "name"     => $p->title,
                    ];
                }
                $itemListSchema = [
                    "@context" => "https://schema.org",
                    "@type"    => "ItemList",
                    "itemListElement" => $items,
                ];
            }
        @endphp

        <script type="application/ld+json">
            {!! json_encode($breadcrumbsSchema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>

        @if($itemListSchema)
            <script type="application/ld+json">
                {!! json_encode($itemListSchema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
            </script>
        @endif
    @endpush
@endonce

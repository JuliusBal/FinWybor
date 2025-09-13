@php
    $title     = 'Pliki cookies | FinWybor.pl';
    $desc      = 'Jak używamy plików cookies i jak możesz zarządzać zgodami w FinWybor.pl.';
    $canonical = route('cookies');
@endphp

@section('title', $title)
@section('meta_description', $desc)
@section('canonical', $canonical)
@section('og_title', $title)
@section('og_description', $desc)

@once
    @push('meta')
        <script type="application/ld+json">
            {!! json_encode([
              '@context' => 'https://schema.org',
              '@type'    => 'WebPage',
              'name'     => 'Pliki cookies',
              'url'      => $canonical,
              'inLanguage' => 'pl-PL',
              'isPartOf' => ['@type'=>'WebSite','name'=>'FinWybor.pl','url'=>url('/')],
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
        <script type="application/ld+json">
            {!! json_encode([
              '@context' => 'https://schema.org',
              '@type'    => 'BreadcrumbList',
              'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Start','item'=>url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>'Pliki cookies','item'=>$canonical],
              ],
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endpush
@endonce

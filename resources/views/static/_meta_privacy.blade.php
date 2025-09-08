@php
    $title     = 'Polityka prywatności | FinWybor.pl';
    $desc      = 'Informacje o przetwarzaniu danych osobowych i cookies.';
    $canonical = route('privacy');
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
              '@context'     => 'https://schema.org',
              '@type'        => 'WebPage',
              'name'         => 'Polityka prywatności',
              'url'          => $canonical,
              'inLanguage'   => 'pl-PL',
              'dateModified' => now()->toIso8601String(),
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
        <script type="application/ld+json">
            {!! json_encode([
              '@context' => 'https://schema.org',
              '@type'    => 'BreadcrumbList',
              'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Start','item'=>url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>'Polityka prywatności','item'=>$canonical],
              ],
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endpush
@endonce

@php
    $title     = 'O nas | FinWybor.pl';
    $desc      = 'Kim jesteśmy, jak działamy i w jaki sposób zarabiamy – transparentnie o FinWybor.pl.';
    $canonical = route('about');
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
              '@type'    => 'AboutPage',
              'name'     => 'O nas',
              'url'      => $canonical,
              'inLanguage' => 'pl-PL',
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
        <script type="application/ld+json">
            {!! json_encode([
              '@context' => 'https://schema.org',
              '@type'    => 'BreadcrumbList',
              'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Start','item'=>url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>'O nas','item'=>$canonical],
              ],
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endpush
@endonce

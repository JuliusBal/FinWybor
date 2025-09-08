@php
    $title     = 'Kontakt | FinWybor.pl';
    $desc      = 'Skontaktuj się z nami – formularz kontaktowy.';
    $canonical = route('contact.create');
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
              '@context'   => 'https://schema.org',
              '@type'      => 'ContactPage',
              'name'       => 'Kontakt',
              'url'        => $canonical,
              'inLanguage' => 'pl-PL',
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>

        <script type="application/ld+json">
            {!! json_encode([
              '@context' => 'https://schema.org',
              '@type'    => 'BreadcrumbList',
              'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Start','item'=>url('/')],
                ['@type'=>'ListItem','position'=>2,'name'=>'Kontakt','item'=>$canonical],
              ],
            ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endpush
@endonce

@php
    use Illuminate\Support\Str;

    $img       = $post->thumbnail_url;
    $title     = $post->title;
    $desc      = $post->excerpt ?: Str::limit(strip_tags((string) $post->body), 160);
    $canonical = route('posts.show', ['post' => $post]);
@endphp

@section('title', $title)
@section('meta_description', $desc)
@section('canonical', $canonical)
@section('og_type', 'article')
@section('og_title', $title)
@section('og_description', $desc)
@section('og_image', $img ?? asset('images/og-default.jpg'))

@once
    @push('meta')
        @php
            $blogPosting = [
                "@context"       => "https://schema.org",
                "@type"          => "BlogPosting",
                "headline"       => $title,
                "description"    => $desc,
                "image"          => $img ?? asset('images/og-default.jpg'),
                "datePublished"  => optional($post->published_at)->toIso8601String(),
                "dateModified"   => optional($post->updated_at)->toIso8601String(),
                "inLanguage"     => "pl-PL",
                "articleSection" => $post->category->name ?? 'Blog',
                "author"         => ["@type"=>"Organization","name"=>"FinWybor.pl"],
                "publisher"      => [
                    "@type" => "Organization",
                    "name"  => "FinWybor.pl",
                    "logo"  => ["@type"=>"ImageObject","url"=>asset('images/og-default.jpg')],
                ],
                "mainEntityOfPage" => $canonical,
            ];

            $crumbs = [
                ["@type"=>"ListItem","position"=>1,"name"=>"Start","item"=>url('/')],
                ["@type"=>"ListItem","position"=>2,"name"=>"Blog","item"=>route('posts.index')],
            ];
            if ($post->category?->slug) {
                $crumbs[] = [
                    "@type"=>"ListItem","position"=>3,
                    "name"=>$post->category->name,
                    "item"=>route('posts.index', ['category'=>$post->category->slug])
                ];
            }
            $crumbs[] = [
                "@type"=>"ListItem",
                "position"=>count($crumbs)+1,
                "name"=>$title,
                "item"=>$canonical
            ];

            $breadcrumbSchema = [
                "@context" => "https://schema.org",
                "@type"    => "BreadcrumbList",
                "itemListElement" => $crumbs,
            ];
        @endphp

        <script type="application/ld+json">
            {!! json_encode($blogPosting, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
        <script type="application/ld+json">
            {!! json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endpush
@endonce

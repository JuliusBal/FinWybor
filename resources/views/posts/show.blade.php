@extends('layouts.app')

@include('posts._meta_show', ['post' => $post])

@section('content')
    {{-- HERO --}}
    <section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 text-white">
        <div class="absolute inset-0 bg-grid-faint opacity-[.06] pointer-events-none"></div>

        <div class="relative max-w-3xl mx-auto px-4 md:px-6 py-10 md:py-14">
            <nav class="text-xs text-white/70 mb-3">
                <a href="{{ route('posts.index') }}" class="hover:text-white/90">Artykuły</a>
                <span class="mx-2">›</span>
                <span>{{ $post->category?->name ?? 'Bez kategorii' }}</span>
            </nav>

            <h1 class="text-2xl md:text-4xl font-bold leading-tight">{{ $post->title }}</h1>

            <div class="text-xs text-white/80 mt-2">
                {{ $post->category?->name ?? '—' }} ·
                {{ optional($post->published_at)->format('Y-m-d') }}
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <div class="max-w-3xl mx-auto px-4 md:px-6 py-8">
        @if($post->thumbnail_url)
            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="w-full rounded-xl shadow-soft mb-6">
        @endif

        <article class="prose prose-slate prose-lg max-w-none">
            {!! $post->body !!}
        </article>

        <div class="mt-10">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-sm text-brand-500 hover:text-brand-400">
                ‹ Wróć do artykułów
            </a>
        </div>
    </div>
@endsection

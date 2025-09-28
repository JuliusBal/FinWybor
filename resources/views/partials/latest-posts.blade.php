@if(!empty($posts) && count($posts))
    <section class="relative isolate py-12 md:py-16">
        <div class="pointer-events-none absolute inset-0 -z-10 bg-gradient-to-b from-white via-slate-50/60 to-white"></div>
        <div class="pointer-events-none absolute inset-0 -z-10 opacity-[.05] bg-grid-faint"></div>

        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 text-[11px] font-semibold uppercase tracking-wide text-brand-800/70">
                        <span class="inline-block h-2 w-2 rounded-full bg-brand-400"></span>
                        Z aktualności
                    </div>
                    <h2 class="mt-2 text-2xl md:text-3xl font-bold tracking-tight text-brand-900">Najnowsze artykuły</h2>
                    <p class="mt-1 text-slate-600">Porady, rankingi i wyjaśnienia bez marketingowego smogu.</p>
                </div>

                <a href="{{ route('posts.index') }}"
                   class="hidden md:inline-flex items-center gap-2 rounded-lg bg-brand-400/90 px-3 py-2
                text-white hover:bg-brand-500 transition-colors shadow-soft font-semibold">
                    Zobacz wszystkie
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                </a>
            </div>

            <div class="mt-6 grid gap-6 sm:grid-cols-2 md:grid-cols-3">
                @foreach($posts as $post)
                    @php
                        $isNew = $post->published_at && $post->published_at->gt(now()->subDays(7));
                    @endphp

                    <article class="group relative overflow-hidden rounded-2xl bg-white shadow-card hover:shadow-lg transition-all">
                        <a href="{{ route('posts.show', $post->slug) }}" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-300 rounded-2xl">
                            <div class="relative aspect-[16/9] overflow-hidden">
                                @if($post->thumbnail_url)
                                    <img src="{{ $post->thumbnail_url }}"
                                         alt="{{ $post->title }}"
                                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
                                @else
                                    <div class="h-full w-full bg-gradient-to-br from-brand-300/30 to-brand-400/20"></div>
                                @endif

                                <span class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/35 via-black/0 to-transparent"></span>

                                @if($post->category?->name)
                                    <span class="absolute left-3 top-3 z-10 inline-flex items-center px-2 py-1 rounded-full text-xs
                              bg-white/90 text-brand-800 shadow-soft">
                  {{ $post->category->name }}
                </span>
                                @endif

                                @if($isNew)
                                    <span class="absolute right-3 top-3 z-10 inline-flex items-center rounded-full px-2 py-1 text-[11px]
                              font-semibold bg-brand-400 text-white shadow-soft">
                  Nowy
                </span>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="text-base md:text-lg font-semibold text-brand-900 group-hover:text-brand-700 transition-colors line-clamp-2">
                                    {{ $post->title }}
                                </h3>

                                @if(!empty($post->excerpt))
                                    <p class="mt-2 text-sm text-slate-600 line-clamp-3">{{ $post->excerpt }}</p>
                                @endif

                                <div class="mt-4 flex items-center justify-between text-xs text-slate-500">
                                    @if($post->published_at)
                                        <time datetime="{{ $post->published_at->toISOString() }}">
                                            {{ $post->published_at->format('Y-m-d') }}
                                        </time>
                                    @endif
                                    <span class="inline-flex items-center gap-1 font-semibold text-brand-700 group-hover:text-brand-500">
                  Czytaj
                  <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="mt-6 md:hidden">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-brand-400/90 px-3 py-2
                text-white hover:bg-brand-500 transition-colors shadow-soft font-semibold">
                    Zobacz wszystkie
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                </a>
            </div>
        </div>
    </section>
@endif

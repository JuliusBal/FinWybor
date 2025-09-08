<?php

namespace App\Services\Search;

use App\Models\Post;
use App\Support\CacheKey;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class SpatieSearchService
{
    public function paginate(string $q, ?string $catSlug, string $sort, int $page, int $perPage): LengthAwarePaginator
    {
        return Cache::tags(['search','posts'])->remember(
          CacheKey::search($q, $catSlug, $sort, $page, $perPage),
            now()->addMinutes(3),
            function () use ($q, $catSlug, $sort, $page, $perPage) {
                $search = (new Search())->registerModel(Post::class, function (ModelSearchAspect $aspect) use ($catSlug) {
                    $aspect->addSearchableAttribute('title')
                        ->addSearchableAttribute('excerpt')
                        ->addSearchableAttribute('body')
                        ->where('status', 'published')
                        ->when($catSlug, fn($qr) => $qr->whereHas('category', fn($c) => $c->where('slug', $catSlug)))
                        ->with(['category:id,name,slug']);
                });

                $results = method_exists($search,'search') ? $search->search($q) : $search->perform($q);

                $models = $results->map(fn($r) => $r->searchable)->unique('id')->values();

                $models = match ($sort) {
                    'popular' => $models->sortByDesc(fn ($p) => $p->views ?? 0)->values(),
                    'az'      => $models->sortBy('title', SORT_NATURAL | SORT_FLAG_CASE)->values(),
                    default   => $models->sortByDesc(fn ($p) => $p->published_at)->values(),
                };

                $slice = $models->forPage($page, $perPage)->values();

                return new LengthAwarePaginator(
                    $slice, $models->count(), $perPage, $page,
                    ['path' => url()->current(), 'query' => request()->query()]
                );
            }
        );
    }
}

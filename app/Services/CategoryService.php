<?php

namespace App\Services;

use App\Models\Category;
use App\Support\CacheKey;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    public function listWithPublishedCounts()
    {
        return Cache::tags(['categories','posts'])->remember(
            CacheKey::categories(),
            now()->addMinutes(30),
            fn() => Category::query()
                ->whereHas('posts', fn($q) => $q->published())
                ->withCount(['posts as published_posts_count' => fn($q) => $q->published()])
                ->orderBy('name')
                ->get(['id','name','slug'])
        );
    }
}

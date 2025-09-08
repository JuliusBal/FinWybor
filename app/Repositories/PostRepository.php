<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository
{
    public function paginate(?string $catSlug, string $sort, int $page, int $perPage): LengthAwarePaginator
    {
        $query = Post::query()
            ->with(['category:id,name,slug'])
            ->select(['id','slug','title','excerpt','published_at','category_id','thumbnail_path'])
            ->published()
            ->inCategorySlug($catSlug)
            ->sortOption($sort);

        return $query->paginate($perPage, ['*'], 'page', $page)->withQueryString();
    }
}

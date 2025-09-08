<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Services\CategoryService;
use App\Services\Search\SpatieSearchService;
use App\Support\CacheKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(
        private readonly PostRepository $posts,
        private readonly CategoryService $cats,
        private readonly SpatieSearchService $search
    ) {}

    public function index(Request $r)
    {
        $q       = trim((string) $r->query('q',''));
        $sort    = $r->query('sort','newest');
        if (!in_array($sort, ['newest','az','popular'], true)) $sort = 'newest';

        $catSlug = $r->query('category');
        $catSlug = $catSlug ? Str::slug($catSlug) : null;

        $page    = max(1, (int) $r->query('page', 1));
        $perPage = (int) $r->query('perPage', 10);
        if ($perPage < 6 || $perPage > 48) $perPage = 10;

        $categories = $this->cats->listWithPublishedCounts();

        if ($q !== '') {
            $posts = $this->search->paginate($q, $catSlug, $sort, $page, $perPage);
        } else {
            $listKey = CacheKey::postsIndex($catSlug, $sort, $page, $perPage);
            $posts = Cache::tags(['posts', $catSlug ? "cat:{$catSlug}" : 'cat:all'])->remember(
                $listKey, now()->addMinutes(5),
                fn() => $this->posts->paginate($catSlug, $sort, $page, $perPage)
            );
        }

        return view('posts.index', compact('posts','categories','q','sort','catSlug'));
    }

    public function show(\App\Models\Post $post)
    {
        abort_unless($post->status === 'published', 404);
        return view('posts.show', compact('post'));
    }
}

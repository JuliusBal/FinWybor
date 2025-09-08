<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, Category $category)
    {
        $q    = trim($request->query('q', ''));
        $sort = $request->query('sort', 'newest');

        $posts = Post::query()
            ->with('category')
            ->where('category_id', $category->id)
            ->when($q !== '', function ($qq) use ($q) {
                $qq->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%")
                        ->orWhere('excerpt', 'like', "%{$q}%")
                        ->orWhere('body', 'like', "%{$q}%");
                });
            })
            ->when($sort === 'az', function ($qq) {
                $qq->orderBy('title');
            })
            ->when($sort === 'popular', function ($qq) {
                $qq->when(schema()->hasColumn('posts', 'views'),
                    fn ($q) => $q->orderByDesc('views'),
                    fn ($q) => $q->orderByDesc('published_at')->orderByDesc('id')
                );
            }, function ($qq) {
                $qq->orderByDesc('published_at')->orderByDesc('id');
            })
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('posts.index', [
            'posts'      => $posts,
            'q'          => $q,
            'sort'       => $sort,
            'categories' => $categories,
            'catSlug'    => $category->slug,
        ]);
    }
}

if (! function_exists('schema')) {
    function schema()
    {
        return app('db')->connection()->getSchemaBuilder();
    }
}

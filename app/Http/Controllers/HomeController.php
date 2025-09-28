<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('home.latest_posts', now()->addMinutes(10), function () {
            return Post::query()
                ->published()
                ->sortOption('newest')
                ->limit(3)
                ->get(['id','title','slug','excerpt','thumbnail_path','published_at','status']);
        });

        return view('home', compact('posts'));
    }
}

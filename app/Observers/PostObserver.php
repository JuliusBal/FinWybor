<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public function saved(Post $post): void
    {
        Cache::tags(['posts','categories','search'])->flush();
    }
    public function deleted(Post $post): void
    {
        Cache::tags(['posts','categories','search'])->flush();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    protected $fillable = [
        'category_id','provider_id','title','slug','excerpt','body','thumbnail_path','status','published_at',
    ];
    protected $casts = ['published_at' => 'datetime'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function scopePublished($q)
    {
        return $q->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeInCategorySlug($q, ?string $slug)
    {
        if (!$slug) return $q;
        return $q->whereHas('category', fn($c) => $c->where('slug', $slug));
    }

    public function scopeSortOption($q, string $sort)
    {
        return match ($sort) {
            'az'      => $q->orderBy('title')->orderBy('id'),
            'popular' => config('features.views', false)
                ? $q->orderByDesc('views')->orderByDesc('published_at')->orderByDesc('id')
                : $q->orderByDesc('published_at')->orderByDesc('id'),
            default   => $q->orderByDesc('published_at')->orderByDesc('id'),
        };
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        $p = $this->thumbnail_path;
        if (!$p) return null;
        if (Str::startsWith($p, ['http://','https://','/'])) return $p;

        $clean = ltrim(preg_replace('#^(public/|storage/)#', '', $p), '/');
        return Storage::disk('public')->exists($clean)
            ? Storage::disk('public')->url($clean)
            : asset($p);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->title, route('posts.show', $this->slug));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

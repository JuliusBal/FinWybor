<?php

namespace App\Support;

final class CacheKey
{
    public static function postsIndex(?string $catSlug, string $sort, int $page, int $perPage): string
    {
        return sprintf('posts:index:v3:cat:%s:sort:%s:page:%d:pp:%d',
            $catSlug ?: 'all', $sort, $page, $perPage
        );
    }

    public static function search(string $q, ?string $catSlug, string $sort, int $page, int $perPage): string
    {
        return sprintf('search:v2:q:%s:cat:%s:sort:%s:page:%d:pp:%d',
            md5($q), $catSlug ?: 'all', $sort, $page, $perPage
        );
    }

    public static function categories(): string
    {
        return 'categories:with_published_counts:v1';
    }
}

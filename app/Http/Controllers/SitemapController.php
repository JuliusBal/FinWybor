<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke(Request $request)
    {
        $xml = Cache::remember('sitemap.xml', 3600, function () {
            $sitemap = Sitemap::create();

            $sitemap->add(
                Url::create(route('home'))
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setLastModificationDate(now())
            );

            $static = [
                route('faq'),
                route('terms'),
                route('privacy'),
                route('contact.create'),
            ];
            foreach ($static as $url) {
                $sitemap->add(
                    Url::create($url)
                        ->setPriority(0.4)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setLastModificationDate(now())
                );
            }

            $offerCombos = [
                route('offers.index', ['type' => 'loan', 'amount' => 3000, 'term' => 6]),
                route('offers.index', ['type' => 'loan', 'amount' => 3000, 'term' => 6, 'sort' => 'cheapest']),
                route('offers.cards'),
                route('offers.insurance'),
            ];
            foreach ($offerCombos as $url) {
                $sitemap->add(
                    Url::create($url)
                        ->setPriority(0.7)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setLastModificationDate(now())
                );
            }

            $perPage   = 12;
            $total     = Post::query()->where('status', 'published')->count();
            $pages     = max(1, (int)ceil($total / $perPage));

            for ($p = 1; $p <= $pages; $p++) {
                $url = $p > 1
                    ? route('posts.index', ['page' => $p])
                    : route('posts.index');

                $sitemap->add(
                    Url::create($url)
                        ->setPriority($p === 1 ? 0.7 : 0.5)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setLastModificationDate(now())
                );
            }

            Post::query()
                ->where('status', 'published')
                ->orderByDesc('updated_at')
                ->cursor()
                ->each(function (Post $post) use ($sitemap) {
                    $sitemap->add(
                        Url::create(route('posts.show', $post->slug))
                            ->setPriority(0.8)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setLastModificationDate($post->updated_at ?? $post->created_at ?? now())
                    );
                });

            Category::query()
                ->orderBy('name')
                ->cursor()
                ->each(function (Category $cat) use ($sitemap) {
                    $sitemap->add(
                        Url::create(route('categories.show', $cat->slug))
                            ->setPriority(0.6)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setLastModificationDate($cat->updated_at ?? now())
                    );
                });

            return $sitemap->render();
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}

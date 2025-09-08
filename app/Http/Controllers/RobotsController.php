<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        if (! app()->isProduction()) {
            return response("User-agent: *\nDisallow: /\n", 200)
                ->header('Content-Type', 'text/plain; charset=UTF-8')
                ->header('X-Robots-Tag', 'noindex, nofollow, nosnippet, noarchive');
        }

        $lines = [
            'User-agent: *',
            'Disallow:',
            'Sitemap: '.rtrim(config('app.url'), '/').'/sitemap.xml',
        ];

        return response(implode("\n", $lines)."\n", 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}

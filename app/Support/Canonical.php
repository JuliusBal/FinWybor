<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Routing\Exceptions\UrlGenerationException;

class Canonical
{
    public function build(Request $request, ?string $routeName = null, array $routeParams = []): string
    {
        $cfg = config('seo.canonical');

        $routeName ??= optional($request->route())->getName();

        $routeParams = array_merge($request->route()?->parameters() ?? [], $routeParams);

        try {
            $path = $routeName
                ? route($routeName, $routeParams, false)
                : '/'.ltrim($request->path(), '/');
        } catch (UrlGenerationException $e) {
            $path = '/'.ltrim($request->path(), '/');
        }

        $whitelist = Arr::get($cfg, "param_whitelist.$routeName", []);
        $blacklist = $cfg['param_blacklist_global'] ?? [];

        $q = collect($request->query())
            ->except($blacklist)
            ->only($whitelist);

        $defaults = Arr::get($cfg, "param_remove_if_default.$routeName", []);
        foreach ($defaults as $key => $value) {
            if ((string)($q[$key] ?? null) === (string)$value) {
                $q->forget($key);
            }
        }

        $q = $q->reject(fn($v) => $v === null || $v === '' || (is_array($v) && $v === []))->sortKeys();
        $query = $q->isEmpty() ? '' : '?'.http_build_query($q->all());

        $host   = $cfg['host']   ?? $request->getHost();
        $scheme = $cfg['scheme'] ?? $request->getScheme();

        if ($cfg['enforce_www'] ?? false) {
            $host = Str::startsWith($host, 'www.') ? $host : 'www.'.$host;
        } else {
            $host = Str::replaceFirst('www.', '', $host);
        }

        if (($cfg['strip_trailing_slash'] ?? true) && $path !== '/') {
            $path = rtrim($path, '/');
        }

        return $scheme.'://'.$host.$path.$query;
    }
}

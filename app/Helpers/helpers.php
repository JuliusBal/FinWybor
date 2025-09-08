<?php

use App\Support\Canonical;

if (! function_exists('canonical_url')) {
    function canonical_url(?string $routeName = null, array $params = []): string {
        return app(Canonical::class)->build(request(), $routeName, $params);
    }
}

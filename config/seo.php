<?php

return [
    'canonical' => [
        'scheme' => env('SEO_CANONICAL_SCHEME', 'https'),
        'host'   => env('SEO_CANONICAL_HOST', 'FinWybor.pl'),
        'enforce_www' => false,
        'strip_trailing_slash' => true,

        'param_blacklist_global' => [
            'utm_source','utm_medium','utm_campaign','utm_term','utm_content',
            'gclid','fbclid','ref','source','igshid','mc_cid','mc_eid',
        ],

        'param_whitelist' => [
            'offers.index' => ['type','amount','term','sort','page','q'],
            'posts.index'  => ['category','sort','page','q'],
            'posts.show'   => [],
        ],

        'param_remove_if_default' => [
            'offers.index' => ['sort' => 'brand', 'page' => 1],
            'posts.index'  => ['sort' => 'newest','page' => 1],
        ],
    ],
];

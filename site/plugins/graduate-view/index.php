<?php

// Thanks to trych for sharing the code!

if (($user = kirby()->user()) && $user->role() == 'graduate') {
    $site = __DIR__ . '/blueprints/graduate/site.yml';
    $thesis = __DIR__ . '/blueprints/graduate/pages/thesis.yml';
} else {
    $site = __DIR__ . '/blueprints/site.yml';
    $thesis = __DIR__ . '/blueprints/pages/thesis.yml';
}

Kirby::plugin('cxxyyl/graduate-view', [
    'blueprints' => [
        'site' => $site,
        'pages/thesis' => $thesis
    ]
]);
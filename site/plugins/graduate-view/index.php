<?php

// Thanks to trych for sharing the code!

if(($user = kirby()->user()) && $user->role() == 'graduate') {
    $dir = __DIR__ . '/blueprints/graduate/site.yml';
} else {
    $dir = __DIR__ . '/blueprints/site.yml';
}

Kirby::plugin('cxxyyl/graduate-view', [
    'blueprints' => [
        'site' => $dir
    ]
]);


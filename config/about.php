<?php

return [
    'headline' => 'Traditional values. Modern needs.',

    'intro' => 'At Subedi & Suppliers, we bring together the timeless beauty of Khasa goods and the everyday practicality of metalware — so you can find the right pieces for your home, your rituals and your daily life.',

    // Base names (no extension). The view resolves .webp > .jpg > .jpeg > .png.
    'images' => [
        'hero' => 'images/firstimage',
        'range' => 'images/secondimage',
        'promise' => 'images/thirdimage',
    ],

    // Sticky chapters. Optional per chapter:
    //   'link'  => ['label' => 'Browse Khasa →', 'route' => 'products.index', 'params' => ['category' => 'kasa']]
    //   'focus' => ['position' => '30% 40%', 'scale' => '1.06']  (crop of the shared range photo)
    // NOTE: the link is stored as a route name (+ params) instead of a URL, because
    // config files are loaded before the router is registered and route() would fail.
    'chapters' => [
        [
            'title' => 'Khasa goods',
            'text' => 'Traditional household and cultural pieces.',
            'link' => [
                'label' => 'Browse Khasa →',
                'route' => 'products.index',
                'params' => ['category' => 'kasa'],
            ],
            'focus' => ['position' => '18% 28%', 'scale' => '1.35'],
        ],
        [
            'title' => 'Metalware',
            'text' => 'Products for kitchens, homes and everyday needs.',
            'link' => [
                'label' => 'Browse all products →',
                'route' => 'products.index',
                'params' => [],
            ],
            'focus' => ['position' => '62% 62%', 'scale' => '1.15'],
        ],
        [
            'title' => 'The selection',
            'text' => 'Every piece is chosen for its finish, its weight in the hand and how well it holds up to daily use.',
            'focus' => ['position' => '50% 50%', 'scale' => '1'],
        ],
    ],

    'values' => [
        // TODO: confirm with the client
        [
            'title' => 'Craftsmanship',
            'text' => 'Care in material and finish.',
        ],
        [
            'title' => 'Quality',
            'text' => 'Products chosen for everyday use.',
        ],
        [
            'title' => 'Honest dealing',
            'text' => 'Clear and helpful guidance.',
        ],
        [
            'title' => 'Customer care',
            'text' => 'Help finding the right product.',
        ],
    ],

    'process' => [
        // TODO: replace with real content from the client
    ],

    'stats' => [
        // TODO: replace with real content from the client
    ],

    // TODO: confirm this line with the shop owner
    'statement' => 'We choose every piece the way we would choose it for our own home.',

    'founder' => null,
];

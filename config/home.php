<?php

return [
    // Trust strip. The first two numbers come from the database (see HomeController).
    // TODO: confirm the two static items below with the shop owner before launch.
    'trust' => [
        ['value' => 'WhatsApp', 'label' => 'Quick enquiries'],
        ['value' => 'Bulk orders', 'label' => 'Welcome'],
    ],

    // "Shop by use": each tile links to the best-fitting category.
    'occasions' => [
        ['title' => 'Puja & ritual', 'text' => 'Lamps, urlis and kalash for the home shrine.', 'category' => 'brass'],
        ['title' => 'Water & drinkware', 'text' => 'Jugs, glasses and trays in copper.', 'category' => 'copper'],
        ['title' => 'Thali & dining', 'text' => 'Traditional kasa for serving and the table.', 'category' => 'kasa'],
        ['title' => 'Everyday kitchen', 'text' => 'Durable steel for daily cooking and storage.', 'category' => 'steel'],
    ],

    // "Know your metals" guide. TODO: draft copy, verify with the shop owner. No health claims.
    'metals' => [
        [
            'slug' => 'copper', 'name' => 'Copper',
            'tagline' => 'Warm, glowing and made for water and serving.',
            'uses' => ['Water jugs and glasses', 'Serving trays', 'Kalash'],
            'care' => ['Hand wash with mild soap and dry fully.', 'Rub with lemon and salt now and then to bring the shine back.'],
        ],
        [
            'slug' => 'brass', 'name' => 'Brass',
            'tagline' => 'Golden, sturdy and at home in kitchen and shrine.',
            'uses' => ['Cooking pots', 'Puja lamps and urlis', 'Spatulas and serving ware'],
            'care' => ['Wipe with a soft cloth after use.', 'Clean tarnish with lemon or tamarind and salt, then rinse and dry.'],
        ],
        [
            'slug' => 'kasa', 'name' => 'Kasa',
            'tagline' => 'A bronze alloy with deep cultural roots.',
            'uses' => ['Puja thali', 'Water pots', 'Bells and diyas'],
            'care' => ['Hand wash and dry thoroughly.', 'Avoid harsh scrubbers on the finished surface.'],
        ],
    ],
];

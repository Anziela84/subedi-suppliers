<?php

return [
    'phones' => [
        // Replace with actual phone numbers
        '+977-000-000-000',
        '+977-000-000-001',
    ],

    'emails' => [
        // Replace with actual email addresses
        'info@subedisuppliers.com',
        'support@subedisuppliers.com',
    ],

    'business_hours' => 'Sun - Fri, 9:00 AM - 6:00 PM',

    'hours' => [
        'days' => [0, 1, 2, 3, 4, 5],
        'open' => '09:00',
        'close' => '18:00',
    ],

    'address_lines' => [
        // Replace with actual address lines
        'Itahari',
        'Nepal',
    ],

    'whatsapp' => env('SITE_WHATSAPP', ''),

    'admin_emails' => array_values(array_filter(array_map('trim', explode(',', (string) env('ADMIN_EMAILS', ''))), fn ($email) => $email !== '')),

    'map_embed_url' => env('SITE_MAP_EMBED_URL', null),

    'map_directions_url' => env('SITE_MAP_DIRECTIONS_URL', 'https://www.google.com/maps?q=Itahari,Nepal'),

    'route_video_url' => env('SITE_ROUTE_VIDEO_URL', null), // Not used on the contact page for now; kept for later

    'socials' => [
        'facebook' => env('SITE_FACEBOOK_URL', '#'),
        'instagram' => env('SITE_INSTAGRAM_URL', '#'),
        'youtube' => env('SITE_YOUTUBE_URL', '#'),
    ],
];

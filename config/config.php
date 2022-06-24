<?php

return [
    'resolvers' => [
        'default' => [
            'type' => 'storage',
            'config' => [
                'disk' => 'imagine',
            ]
        ],
    ],

    'loaders' => [
        'default' => [
            'type' => 'storage',
            'config' => [
                'disk' => 'public',
            ]
        ],
    ],

    'default_preset_settings' => [
        'quality' => 100,
        'jpeg_quality' => null,
        'png_compression_level' => 7,
        'png_compression_filter' => 8,
        'format' => null,
    ],

    'driver' => 'gd',

    'cache_store' => 'array',

    'presets' => [
        'thumbnail' => [
            'quality' => '75',
            'format' => 'webp',
            'filters' => [
                'thumbnail' => ['size' => [640, 480], 'mode' => 'outbound'],
            ],
        ],
        'resized' => [
            'filters' => [
                'relative_resize' => ['widen' =>  500]
            ]
        ]
    ],
];

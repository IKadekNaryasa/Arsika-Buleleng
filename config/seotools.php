<?php

/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        'defaults'       => [
            'title'        => "",
            'titleBefore'  => false,
            'description'  => 'Sistem informasi yang dirancang untuk mengelola dan menyimpan data Arsip Kesbangpol Buleleng secara digital dan terstruktur. Dilengkapi dengan fitur sinkronisasi Google Drive.',
            'separator'    => ' - ',
            'keywords'     => ['ARSIKA Buleleng', 'Arsip Digital', 'Kesbangpol Buleleng', 'Sistem Informasi Arsip', 'Badan Kesatuan Bangsa dan Politik Buleleng', 'Arsip Digital Pemerintah'],
            'canonical'    => env('APP_URL', 'https://arsika.bkbp.site'),
            'robots'       => 'index, follow',
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'ARSIKA Buleleng - Arsip Digital Kesbangpol Buleleng',
            'description' => 'Sistem informasi yang dirancang untuk mengelola dan menyimpan data Arsip Kesbangpol Buleleng secara digital dan terstruktur.',
            'url'         => env('APP_URL', 'https://arsika.bkbp.site'),
            'type'        => 'website',
            'site_name'   => 'ARSIKA Buleleng',
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card'  => 'summary_large_image',
            'site' => '@arsika_buleleng',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'ARSIKA Buleleng',
            'description' => 'Sistem informasi untuk mengelola dan menyimpan data Arsip Kesbangpol Buleleng secara digital.',
            'url'         => env('APP_URL', 'https://arsika.bkbp.site'),
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];

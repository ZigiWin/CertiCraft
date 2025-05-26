<?php
return [
    'callback' => 'http://example.local/CertiCraft/callback.php',

    'providers' => [
        'Google' => [
            'enabled' => true,
            'keys'    => [
                'id'     => 'GOOGLE_CLIENT_ID',
                'secret' => 'GOOGLE_CLIENT_SECRET'
            ],
        ],
        'Yandex' => [
            'enabled' => true,
            'keys'    => [
                'id'     => 'YANDEX_CLIENT_ID',
                'secret' => 'YANDEX_CLIENT_SECRET'
            ],
        ],
        'Vkontakte' => [
            'enabled' => true,
            'keys'    => [
                'id'     => 'VK_APP_ID',
                'secret' => 'VK_APP_SECRET'
            ],
        ],
        'Mailru' => [
            'enabled' => true,
            'keys'    => [
                'id'     => 'MAIL_CLIENT_ID',
                'secret' => 'MAIL_CLIENT_SECRET'
            ],
        ],
    ],
    'debug_mode' => false,
    'debug_file' => __DIR__ . '/hybridauth.log',
];

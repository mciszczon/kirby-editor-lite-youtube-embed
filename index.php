<?php

Kirby::plugin('mciszczon/kirby-editor-lite-youtube-embed', [
    'snippets' => [
        'editor/lite-youtube-embed' => __DIR__ . '/snippets/lite-youtube-embed.php'
    ],
    'translations' => [
        'en' => @include_once __DIR__ . '/i18n/en.php',
        'pl' => @include_once __DIR__ . '/i18n/pl.php',
    ]
]);
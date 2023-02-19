<?php

return [
    'paths' => [
        resource_path('views'),
        base_path('_pages'),
    ],

    'compiled' => \Phar::running()
        ? getcwd() : env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),
];

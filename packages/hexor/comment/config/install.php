<?php

return [
    'packageName' => 'comment',
    'required_service_providers' => [
        LFPackage\Comment\CommentServiceProvider::class
    ],
    'required_facades' => [
        'LFComment' => LFPackage\Comment\Facades\LFComment::class
    ],
    'publish_commands' => [
        'php artisan vendor:publish --provider="LFPackage\Comment\CommentServiceProvider" --tag="view" --force',
        'php artisan vendor:publish --provider="LFPackage\Comment\CommentServiceProvider" --tag="db" --force'
    ]
];

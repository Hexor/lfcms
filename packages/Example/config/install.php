<?php

return [
    'packageName' => 'example',
    'required_service_providers' => [
        LFPackage\Example\ExampleServiceProvider::class
    ],
    'required_facades' => [
//        'LFExample' => LFPackage\Example\Facades\LFExample::class
    ],
    'publish_commands' => [
//        'php artisan vendor:publish --provider="LFPackage\Example\ExampleServiceProvider" --tag="view" --force',
//        'php artisan vendor:publish --provider="LFPackage\Example\ExampleServiceProvider" --tag="db" --force'
    ]
];

<?php

return [
    'packageName' => 'testvs',
    'required_service_providers' => [
        LFPackage\TestVs\TestVsServiceProvider::class
    ],
    'required_facades' => [
//        'LFTestVs' => LFPackage\TestVs\Facades\LFTestVs::class
    ],
    'publish_commands' => [
//        'php artisan vendor:publish --provider="LFPackage\TestVs\TestVsServiceProvider" --tag="view" --force',
//        'php artisan vendor:publish --provider="LFPackage\TestVs\TestVsServiceProvider" --tag="db" --force'
    ]
];

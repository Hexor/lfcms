<?php

return [
    'packageName' => 'testrm',
    'required_service_providers' => [
        LFPackage\TestRm\TestRmServiceProvider::class
    ],
    'required_facades' => [
        'LFTestRm' => LFPackage\TestRm\Facades\LFTestRm::class
    ],
    'publish_commands' => [
//        'php artisan vendor:publish --provider="LFPackage\TestRm\TestRmServiceProvider" --tag="view" --force',
//        'php artisan vendor:publish --provider="LFPackage\TestRm\TestRmServiceProvider" --tag="db" --force'
    ]
];

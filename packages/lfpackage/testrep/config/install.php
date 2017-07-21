<?php

return [
    'packageName' => 'testrep',
    'required_service_providers' => [
        LFPackage\TestRep\TestRepServiceProvider::class
    ],
    'required_facades' => [
//        'LFTestRep' => LFPackage\TestRep\Facades\LFTestRep::class
    ],
    'publish_commands' => [
//        'php artisan vendor:publish --provider="LFPackage\TestRep\TestRepServiceProvider" --tag="view" --force',
//        'php artisan vendor:publish --provider="LFPackage\TestRep\TestRepServiceProvider" --tag="db" --force'
    ]
];

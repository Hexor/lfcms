<?php

namespace LaravelPackageManager\Console\Commands;

use Illuminate\Console\Command;
use LaravelPackageManager\Packages\PackageCreator;
use LaravelPackageManager\Support\Output;
use LaravelPackageManager\Support\UserPrompt;
use LaravelPackageManager\Packages\PackageRequirer;

class CreatePackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:create {package_name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a package which depend on the Example Package.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $creator = new PackageCreator($this);
        $creator->create($this->argument('package_name'));
    }
}

<?php

namespace LaravelPackageManager\Console\Commands;

use Illuminate\Console\Command;
use LaravelPackageManager\Packages\PackageRemover;

class RemovePackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:remove {package_name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a package and the published files.';

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
        $remover = new PackageRemover($this);
        $remover->remove($this->argument('package_name'));
    }
}

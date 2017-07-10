<?php

namespace LaravelPackageManager\Packages;

use LaravelPackageManager\Packages\Package;
use LaravelPackageManager\Support\RunExternalCommand;
use LaravelPackageManager\Support\Output;

class PackagePublisher
{
    protected $output = null;

    /**
     * Constructor
     * @param Output $output
     * @return void
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    /**
     * Install a package using composer.
     * @param Package $package
     * @return void
     */
    public function publish($installConfig)
    {
        $this->output->info('Start publishing files ...');

        $publishCommands = $installConfig['publish_commands'];

        foreach ($publishCommands as $cmd) {
            $runner = new RunExternalCommand($cmd);

            try {
                $runner->run();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage() . PHP_EOL;
            }
        }
        $this->output->info('Publishing complete ...');
    }
}

<?php

namespace LaravelPackageManager\Packages;

use Illuminate\Console\Command;
use LaravelPackageManager\Support\Output;
use LaravelPackageManager\Support\RunExternalCommand;
use LaravelPackageManager\Support\UserPrompt;
use LaravelPackageManager\Support\CommandOptions;

class PackageRemover
{
    /**
     *
     * @var \LaravelPackageManager\Support\Output
     */
    protected $output;

    /**
     * @var \LaravelPackageManager\Support\UserPrompt
     */
    protected $userPrompt;

    /**
     * @var \LaravelPackageManager\Support\CommandOptions
     */
    protected $options;

    /**
     * @var \Illuminate\Console\Command
     */
    protected $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
        $this->output = new Output($this->command);
        $this->userPrompt = new UserPrompt($this->output);
        $this->options = new CommandOptions([]);
    }

    public function runCommand($cmd)
    {
        $runner = new RunExternalCommand($cmd);

        try {
            $runner->run();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . PHP_EOL;
        }
    }

    public function deleteDirectory($path)
    {
        if (file_exists($path)) {
            $cmd = "rm -rf " . $path;
            $this->runCommand($cmd);
        }
    }

    /**
     * Install a package, and register any service providers and/or facades it provides.
     * @param string $packageName
     * @param array $options
     */
    public function remove($packageName)
    {
        $lowerName = strtolower($packageName);
        $cmds = [];


        // 删除 app/config 中的内容
        // package:unregister
        $cmds[] = 'php artisan package:unregister '.$packageName;

        // 去掉软连接
        // composer remove
        $cmds[] = 'composer remove '.$packageName;

        foreach ($cmds as $cmd) {
            $this->command->info($cmd);

            $runner = new RunExternalCommand($cmd);

            try {
                $runner->run();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage() . PHP_EOL;
            }
        }

        // 提示用户是否删除 publish 的view
        $deleteView = $this->userPrompt->promptToDeletePublish('view');
        if ($deleteView) {
            $paths = [];
            $paths[] = base_path()."public/vendor/lfpackage/"."$lowerName";
            $paths[] = base_path()."resources/views/vendor/lfpackage/".$lowerName;
            $paths[] = base_path()."resources/lang/vendor/lfpackage/".$lowerName;
            foreach ($paths as $path) {
                $this->deleteDirectory($path);
            }
        }

        // 提示用户是否删除 publish 的 db
        $deleteDB = $this->userPrompt->promptToDeletePublish('db');
        if ($deleteDB) {

        }

        // 提示用户是否删除 publish 的 config
        $deleteConfig = $this->userPrompt->promptToDeletePublish('config');
        if ($deleteConfig) {

        }

        // 提示用户是否删除 publish 的 config
        $deleteConfig = $this->userPrompt->promptToDeletePublish('route');
        if ($deleteConfig) {

        }

    }
}

<?php

namespace LaravelPackageManager\Packages;

use Illuminate\Console\Command;
use LaravelPackageManager\Packages\Files\PackageFileLocator;
use LaravelPackageManager\Support\CommandOptions;
use LaravelPackageManager\Support\ConfigurationFile;
use LaravelPackageManager\Support\Output;
use LaravelPackageManager\Support\RunExternalCommand;
use LaravelPackageManager\Support\UserPrompt;

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
    protected $config;

    public function __construct(Command $command)
    {
        $this->command = $command;
        $this->output = new Output($this->command);
        $this->userPrompt = new UserPrompt($this->output);
        $this->options = new CommandOptions([]);
        $this->config = new ConfigurationFile('app');
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

    public function unregisterFromInstallConfig($installConfig)
    {
        // TODO 模仿右侧的函数完成取消appconfig中文件的内容
        $this->command->info('Start unregistering ServiceProviders and Facades ...');

        $serviceProviders = $installConfig['required_service_providers'];
        $facades = $installConfig['required_facades'];

        foreach ($serviceProviders as $regline) {
            $configAppFile = $this->config->read();
            $regline .= "::class,";

            if (strpos($configAppFile, $regline)!=false) {
                $count = 0;
                $config = str_replace($regline, '', $configAppFile, $count);

                if ($count > 0) {
                    $this->config->write($config);
                }
            }
        }

        foreach ($facades as $facadeName => $facadeClass) {
            $regline = "'".$facadeName."' => "."$facadeClass"."::class,";
            $configAppFile = $this->config->read();

            if (strpos($configAppFile, $regline)!=false) {
                $count = 0;
                $config = str_replace($regline, '', $configAppFile, $count);

                if ($count > 0) {
                    $this->config->write($config);
                }
            }
        }

        $this->command->info('Unregistering complete.');
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
        $package = new Package($packageName);

        $locator = new PackageFileLocator($package);
        $locator->locateInstallConfig();

        // 删除 app/config 中的内容
        $this->unregisterFromInstallConfig($locator->getInstallConfig());

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

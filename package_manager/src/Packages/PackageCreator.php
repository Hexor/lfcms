<?php

namespace LaravelPackageManager\Packages;

use Illuminate\Console\Command;
use LaravelPackageManager\Support\Output;
use LaravelPackageManager\Support\RunExternalCommand;
use LaravelPackageManager\Support\UserPrompt;
use LaravelPackageManager\Support\CommandOptions;

class PackageCreator
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

    /**
     * Install a package, and register any service providers and/or facades it provides.
     * @param string $packageName
     * @param array $options
     */
    public function create($packageName)
    {
        $lowerName = strtolower($packageName);
        $cmds = [];

        // 复制文件夹
        $cmds[] = 'rm -rf packages/'.$lowerName;
        $cmds[] = 'cp -r packages/Example packages/lfpackage/'.$lowerName;

        // 重命名文件名
        $cmds[] = "find ".  base_path()."/packages/lfpackage/" . $lowerName  ." -name \"*Example*\"|rename 's/Example/".$packageName."/'";
        $cmds[] = "find ".  base_path()."/packages/lfpackage/" . $lowerName  ." -name \"*example*\"|rename 's/example/".$lowerName."/'";

        // 替换代码中的字符串
//        grep oldString -rl /path | xargs sed -i "s/oldString/newString/g"
        $cmds[] = "grep example -rl " . base_path()."/packages/lfpackage/" . $lowerName ." | xargs sed -i " . "\"s/example/" . $lowerName ."/g\"";
        $cmds[] = "grep Example -rl " . base_path()."/packages/lfpackage/" . $lowerName." | xargs sed -i " . "\"s/Example/" . $packageName."/g\"";

        if ($this->output->confirm("Require package now?")){
            $cmds[] = "php artisan package:require lfpackage/".$lowerName;
        }


        foreach ($cmds as $cmd) {
            $this->command->info($cmd);

            $runner = new RunExternalCommand($cmd);

            try {
                $runner->run();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage() . PHP_EOL;
            }
        }

    }
}

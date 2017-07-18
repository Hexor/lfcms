<?php

namespace LaravelPackageManager\Packages;

use LaravelPackageManager\Packages\Package;
use LaravelPackageManager\Support\ComposerFile;
use LaravelPackageManager\Support\RunExternalCommand;

class PackageInstaller
{

    public function __construct()
    {
        $this->projectComposer = new ComposerFile();
    }

    /**
     * Install a package using composer.
     * @param Package $package
     * @return void
     */
    public function install(Package $package, $options = null)
    {
        $this->handleComposerFile($package);
        $cmd = $this->findComposerBinary().' require "'.$package->getName();
//        if ($package->getVersion())
//            $cmd .= ':'.$package->getVersion();
//        if ($options['dev'] == true)
//            $cmd .= ' --dev';
//        if ($options['local-dev'] == true)
//            $cmd .= ':*@dev';

        // 暂时只支持本地包的安装了
        $cmd .= ':*@dev"';

        $runner = new RunExternalCommand($cmd);
        try {
            $runner->run();
        } catch (Exception $e) {
           echo 'Error: '.$e->getMessage().PHP_EOL;
        }
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposerBinary()
    {
        if (file_exists(base_path() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" composer.phar';
        }

        return 'composer';
    }

    private function handleComposerFile($package)
    {
        $composer = $this->projectComposer->read();
        $searchLine = '"repositories": {';
        $regline = '"'.$package->getName().'": {"type": "path", "url": "packages/'.$package->getName().'"}';

        if (strpos($composer, $regline)===false) {
            $count = 0;
            $config = str_replace($searchLine, $searchLine . PHP_EOL . "        $regline".",", $composer, $count);

            if ($count > 0) {
                $this->projectComposer->write($config);
            }
        }

    }

}

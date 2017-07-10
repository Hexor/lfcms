<?php

namespace LaravelPackageManager\Support;

use LaravelPackageManager\Exceptions\ComposerFileNotFoundException;

class ComposerFile
{
    /**
     * @var string
     */
    protected $name = 'composer.json';

    /**
     * Create a new ComposerFile instance, where $name is the name (without extension)
     * of an existing file in basedir/config/.
     * @param string $name
     */
    public function __construct()
    {
        $this->validateFilename();
    }

    /**
     * Validate the filename generated from the $name provided
     * @throws \LaravelPackageManager\Exceptions\ConfigurationFileNotFoundException
     * @return boolean
     */
    protected function validateFilename()
    {
        $filename = $this->filename();

        if (!file_exists($filename))
            throw ComposerFileNotFoundException('File not found: '.$filename);

        return true;
    }

    /**
     * Returns the configuration filename.
     * @return string
     */
    public function filename()
    {
        return base_path().'/'.$this->name;
    }

    /**
     * Read an existing configuration file.
     * @throws \LaravelPackageManager\Exceptions\ConfigurationFileNotFoundException
     * @return string
     */
    public function read()
    {
        return file_get_contents($this->filename());
    }

    /**
     * Write contents to a configuration file.
     * @param string $contents
     * @return string
     */
    public function write($contents)
    {
        return file_put_contents($this->filename(), $contents);
    }

}

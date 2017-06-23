<?php

namespace App;
use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class ComposerScripts
{
    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();
        // do stuff
    }

    public static function postAutoloadDump(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';

    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        $packageName = $event->getOperation()->getPackage()->getName();

    }

    public static function warmCache(Event $event)
    {
        // make cache toasty
    }

    public static function postInstall(Event $event)
    {
    }

    public static function lfInit(Event $event)
    {

    }
}
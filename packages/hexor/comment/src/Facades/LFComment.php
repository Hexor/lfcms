<?php
namespace LFPackage\Comment\Facades;

use Illuminate\Support\Facades\Facade;

class LFComment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'lfcomment';
    }
}

<?php
namespace Dosarkz\Paybox\Facades;

use Illuminate\Support\Facades\Facade;

class Paybox extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Dosarkz\Paybox\Paybox::class;
    }
}
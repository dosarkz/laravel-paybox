<?php
namespace Dosarkz\Paybox\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method generate(array $data)
 * @method paymentInfo(array $data)
 */
class Paybox extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paybox';
    }
}

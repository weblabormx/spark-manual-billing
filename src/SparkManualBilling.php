<?php

namespace WeblaborMx\SparkManualBilling;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class SparkManualBilling
{
    public static $hide_billing = false;

    public static function hideBilling()
    {
        self::$hide_billing = true;
        return new static;
    }
    public static function showBilling()
    {
        return !self::$hide_billing;
    }
}

<?php

namespace WeblaborMx\SparkManualBilling\Traits;

use Illuminate\Support\Facades\Hash;

trait UserCrud
{
    /**
     * Attributes
     */

    public function setPasswordRawAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}

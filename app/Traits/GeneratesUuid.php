<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GeneratesUuid {
    /**
     * Boot function from Laravel.
     */
    protected static function bootGeneratesUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}

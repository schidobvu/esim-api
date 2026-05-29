<?php

namespace App\Services\VXView;

trait BuildsUrl
{
    protected function getBaseUrl(): string
    {
        return config('app.simswap.port')
            ? sprintf('%s:%s', config('app.simswap.host'), config('app.simswap.port'))
            : config('app.simswap.host');
    }
}

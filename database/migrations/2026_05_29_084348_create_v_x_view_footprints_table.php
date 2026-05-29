<?php

use Illuminate\Database\Migrations\Migration;
use TNM\IntegrationsFootprints\Database\FootprintInterface;
use TNM\IntegrationsFootprints\Database\IsFootprint;

return new class extends Migration implements FootprintInterface
{
    use IsFootprint;
    function getTableName(): string
    {
        return 'vx_view_footprints';
    }
};

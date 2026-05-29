<?php

use Illuminate\Database\Migrations\Migration;
use TNM\IntegrationsFootprints\Database\FootprintInterface;
use TNM\IntegrationsFootprints\Database\IsAsyncFootprint;


class CreateAsyncIntegrationsFootprintsTable extends Migration implements FootprintInterface
{
    use IsAsyncFootprint;

    function getTableName(): string
    {
        return 'async_integrations_footprints';
    }
}
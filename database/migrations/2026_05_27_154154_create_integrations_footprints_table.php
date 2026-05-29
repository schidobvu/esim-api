<?php

use Illuminate\Database\Migrations\Migration;
use TNM\IntegrationsFootprints\Database\FootprintInterface;
use TNM\IntegrationsFootprints\Database\IsFootprint;


class CreateIntegrationsFootprintsTable extends Migration implements FootprintInterface
{
   use IsFootprint;

    function getTableName(): string
    {
        return 'integrations_footprints';
    }
}
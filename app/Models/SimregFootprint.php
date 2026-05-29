<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TNM\IntegrationsFootprints\Models\IsFootprint;

class SimregFootprint extends Model
{
    use HasFactory, IsFootprint;

    protected $guarded = [];

}

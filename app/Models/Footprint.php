<?php

namespace App\Models;

use Database\Factories\FootprintFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footprint extends Model
{
    /** @use HasFactory<FootprintFactory> */
    use HasFactory;
    protected $guarded = [];
}

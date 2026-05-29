<?php

namespace App\Models;

use Database\Factories\PermissionRoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    /** @use HasFactory<PermissionRoleFactory> */
    use HasFactory;
}

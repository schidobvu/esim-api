<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Role;

class BlockRoleController extends Controller
{
    public function __invoke(Role $role)
    {
        $role->block();
        return $this->respond()->key('role')->ok($role->fresh()->toArray())->json();
    }
}

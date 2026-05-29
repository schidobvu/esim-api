<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Role;

class GetRoleController extends Controller
{
    public function __invoke(Role $role)
    {
        return $this->respond()->key('role')->ok($role->loadRelations())->json();
    }
}

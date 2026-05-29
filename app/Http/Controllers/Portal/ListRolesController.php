<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Role;

class ListRolesController extends Controller
{
    public function __invoke()
    {
        return $this->respond()->key('roles')->ok(Role::useFilter()->get()->toArray())->json();
    }
}

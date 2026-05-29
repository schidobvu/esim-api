<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class GetPermissionController extends Controller
{
    public function __invoke(Permission $permission)
    {
        return $this->respond()->key('permission')->ok($permission->loadRelations())->json();
    }
}

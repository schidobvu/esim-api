<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class AssignPermissionToRoleController extends Controller
{
    public function __invoke(Role $role, Permission $permission): JsonResponse
    {
        $role->permissions()->attach($permission);
        return $this->respond()->ok()->json();
    }
}

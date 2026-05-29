<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RemovePermissionFromRoleController extends Controller
{
    public function __invoke(Role $role, Permission $permission): JsonResponse
    {
        $role->permissions()->detach($permission);
        return $this->respond()->ok()->json();
    }
}

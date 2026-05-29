<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;

class UpdatePermissionController extends Controller
{
    public function __invoke(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        return $this->respond()->key('permission')->ok($permission->fresh()->toArray())->json();
    }
}

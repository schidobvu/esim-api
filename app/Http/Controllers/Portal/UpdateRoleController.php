<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class UpdateRoleController extends Controller
{
    public function __invoke(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->validated());
        return $this->respond()->key('role')->ok($role->fresh()->toArray())->json();
    }
}

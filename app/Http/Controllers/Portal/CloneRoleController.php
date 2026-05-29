<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\CloneRoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CloneRoleController extends Controller
{
    public function __invoke(CloneRoleRequest $request, Role $role): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        DB::beginTransaction();

        try {
            $clonedRole = $role->replicate();
            $clonedRole->{"name"} = $request->get('name');
            $clonedRole->save();

            $permissions = $role->{'permissions'};
            $clonedRole->permissions()->sync($permissions->pluck('id'));

            DB::commit();

            return $this->respond()->key('role')->ok($clonedRole)->json();

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->respond()->failed($e->getMessage())->json();
        }
    }
}

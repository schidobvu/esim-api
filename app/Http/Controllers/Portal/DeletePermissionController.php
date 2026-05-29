<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;

class DeletePermissionController extends Controller
{
    public function __invoke(Permission $permission): JsonResponse
    {
        $permission->delete();
        return $this->respond()->ok()->json();
    }
}

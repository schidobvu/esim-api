<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;

class ListPermissionsController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->respond()->key('permissions')->ok(Permission::all()->toArray())->json();
    }
}

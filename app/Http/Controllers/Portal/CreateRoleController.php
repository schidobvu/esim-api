<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class CreateRoleController extends Controller
{
    public function __invoke(CreateRoleRequest $request):JsonResponse
    {
        return $this->respond()->key('role')->ok(Role::create($request->validated()))->json();
    }
}

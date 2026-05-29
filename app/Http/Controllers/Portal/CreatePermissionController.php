<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;

class CreatePermissionController extends Controller
{
    public function __invoke(CreatePermissionRequest $request): JsonResponse
    {
        return $this->respond()->key('permission')
            ->ok(Permission::create([...$request->validated(), 'created_by' => auth()->user()->getKey()])->toArray())
            ->json();
    }
}

<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePortalUserRequest;
use App\Models\PortalUser;
use Illuminate\Http\JsonResponse;

class CreatePortalUserController extends Controller
{
    public function __invoke(CreatePortalUserRequest $request): JsonResponse
    {
        return $this->respond()->key('portal_user')->ok(PortalUser::create($request->validated()))->json();
    }
}

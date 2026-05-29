<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePortalUserRequest;
use App\Models\PortalUser;
use Illuminate\Http\JsonResponse;

class UpdatePortalUserController extends Controller
{
    public function __invoke(UpdatePortalUserRequest $request, PortalUser $user): JsonResponse
    {
        $user->update($request->validated());
        return $this->respond()->key('portal_user')->ok($user->fresh()->loadRelations()->toArray())->json();
    }
}

<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\PortalUser;
use Illuminate\Http\JsonResponse;

class UnblockPortalUserController extends Controller
{
    public function __invoke(PortalUser $user): JsonResponse
    {
        $user->unblock();
        return $this->respond()->key('portal_user')->ok($user->fresh()->toArray())->json();
    }
}

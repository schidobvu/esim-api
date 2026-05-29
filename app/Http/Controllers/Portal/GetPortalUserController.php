<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\PortalUser;

class GetPortalUserController extends Controller
{
    public function __invoke(PortalUser $user)
    {
        return $this->respond()->key('portal_user')->ok($user->loadRelations())->json();
    }
}

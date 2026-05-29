<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\PortalUser;

class ListPortalUsersController extends Controller
{
    public function __invoke()
    {
        return $this->respond()->key('portal_users')->ok(PortalUser::useFilter()->paginate(request()->get('perPage')))->json();
    }
}

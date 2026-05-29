<?php

namespace Tests\Feature\Portal\PortalUsers;

use App\Models\PortalUser;
use Tests\TestCase;

class GetPortalUserTest extends TestCase
{
    public function test_get_portal_user(): void
    {
        $user = PortalUser::factory()->create();

        $response = $this->portal()->get('/portal/portal-users/' . $user->getKey());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'portal_user' =>
                [
                    'id', 'name', 'username', 'blocked_at', 'created_by', 'blocked', 'creator', 'role'
                ]
        ]);
    }
}

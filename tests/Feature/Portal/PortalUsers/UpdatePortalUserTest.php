<?php

namespace Tests\Feature\Portal\PortalUsers;

use App\Models\PortalUser;
use App\Models\Role;
use Tests\TestCase;

class UpdatePortalUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_update_portal_user(): void
    {
        $user = PortalUser::factory()->create();
        $role = Role::factory()->create();
        $response = $this->portal()->patch('/portal/portal-users/' . $user->getKey(), [
            "name" => "Test",
            'username' => 'm.kampingo',
            'role_id' => $role->getKey(),
            'login_type' => 'username'
        ]);

        $response->assertOk();
        $response->assertJson([
            'portal_user' => [
                'name' => 'Test',
                'username' => 'm.kampingo',
                'role_id' => $role->getKey()
            ]
        ]);
    }
}

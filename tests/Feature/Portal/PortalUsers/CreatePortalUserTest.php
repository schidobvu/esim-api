<?php

namespace Tests\Feature\Portal\PortalUsers;

use App\Models\Grade;
use App\Models\Role;
use Tests\TestCase;

class CreatePortalUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_portal_user_test(): void
    {
        $role = Role::factory()->create();
        $response = $this->portal()->post('/portal/portal-users', [
            "name" => "Test",
            'username' => 'm.kampingo',
            'login_type' => 'msisdn',
            'role_id' => $role->getKey(),
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

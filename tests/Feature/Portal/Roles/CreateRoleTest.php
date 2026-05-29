<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Role;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_portal_role(): void
    {
        $response = $this->portal()->post('/portal/roles', [
            "name" => "Test",
            "type" => "portal"
        ]);

        $response->assertOk();
        $response->assertJson([
            'role' => [
                'name' => 'Test'
            ]
        ]);
    }

    public function test_create_app_role(): void
    {
        $response = $this->portal()->post('/portal/roles', [
            "name" => "Test",
            "type" => "api",
        ]);

        $response->assertOk();
        $response->assertJson([
            'role' => [
                'name' => 'Test',
            ]
        ]);
    }
}

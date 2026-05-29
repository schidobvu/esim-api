<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Role;
use Tests\TestCase;

class UpdateRoleTest extends TestCase
{
    public function test_update_role(): void
    {
        $role = Role::factory()->create();
        $body = [
            'name' => 'New name',
            'type' => 'portal'
        ];
        $response = $this->portal()->patch('/portal/roles/' . $role->getKey(), $body);

        $response->assertStatus(200);
        $this->assertDatabaseHas(Role::class, $body);
    }
}

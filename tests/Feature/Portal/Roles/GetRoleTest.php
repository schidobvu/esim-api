<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRoleTest extends TestCase
{
    public function test_get_role(): void
    {
        $user = Role::factory()->create();

        $response = $this->portal()->get('/portal/roles/' . $user->getKey());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'role' =>
                [
                    'id', 'name', 'type', 'blocked_at', 'created_by', 'blocked', 'creator', 'permissions'
                ]
        ]);
    }
}

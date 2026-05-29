<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnblockRoleTest extends TestCase
{
    public function test_unblock_client(): void
    {
        $role = Role::factory()->create(['blocked_at' => now()]);

        $response = $this->portal()->patch(sprintf('/portal/roles/%s/unblock', $role->getKey()));

        $response->assertStatus(200);
        $this->assertNull($role->fresh()->{'blocked_at'});
    }
}

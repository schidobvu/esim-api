<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Role;
use Tests\TestCase;

class BlockRoleTest extends TestCase
{
    public function test_block_role(): void
    {
        $role = Role::factory()->create();

        $response = $this->portal()->patch(sprintf('/portal/roles/%s/block', $role->getKey()));

        $response->assertStatus(200);
        $this->assertNotNull($role->fresh()->{'blocked_at'});
    }
}

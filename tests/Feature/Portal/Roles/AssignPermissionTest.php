<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Tests\TestCase;

class AssignPermissionTest extends TestCase
{
    public function test_assign_permission_test(): void
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();

        $response = $this->portal()->put(sprintf('/portal/roles/%s/permissions/%s', $role->getKey(), $permission->getKey()));

        $response->assertStatus(200);
        $this->assertDatabaseHas(PermissionRole::class, ['role_id' => $role->getKey(), 'permission_id' => $permission->getKey()]);
    }
}

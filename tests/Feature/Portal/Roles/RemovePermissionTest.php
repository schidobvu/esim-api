<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Tests\TestCase;

class RemovePermissionTest extends TestCase
{
    public function test_delete_permission_from_role(): void
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();
        $role->permissions()->attach($permission);

        $response = $this->portal()->delete(sprintf('/portal/roles/%s/permissions/%s', $role->getKey(), $permission->getKey()));

        $response->assertStatus(200);
        $this->assertDatabaseMissing(PermissionRole::class, ['client_id' => $role->getKey(), 'permission_id' => $permission->getKey()]);
    }
}

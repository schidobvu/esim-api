<?php

namespace Portal\Roles;

use App\Models\Permission;
use App\Models\Role;

class CloneRoleTest extends \Tests\TestCase
{
    public function test_clone_role(): void
    {
        $role = Role::factory()->create();
        $permissions = Permission::factory()->count(3)->create();
        $role->permissions()->sync($permissions);

        $newRoleName = 'Cloned Role';

        $response = $this->portal()->post(sprintf('/portal/roles/%s/clone', $role->getKey()), ['name' => $newRoleName]);

        $response->assertOk();

        $response->assertJsonFragment(['name' => $newRoleName]);

        $clonedRole = Role::where('name', $newRoleName)->first();

        $this->assertNotNull($clonedRole);

        $this->assertEquals($permissions->pluck('id')->sort()->values(),
            $clonedRole->permissions->pluck('id')->sort()->values());
    }

}

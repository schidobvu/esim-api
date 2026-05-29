<?php

namespace Tests\Feature\Portal\Permissions;

use App\Models\Permission;
use Tests\TestCase;

class ListPermissionsTest extends TestCase
{
    public function test_list_permissions(): void
    {
        Permission::factory(50)->create();

        $response = $this->portal()->get('/portal/permissions');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'permissions' => [
                [
                    'id', 'name', 'code', 'endpoint'
                ]
            ]
        ]);
    }
}

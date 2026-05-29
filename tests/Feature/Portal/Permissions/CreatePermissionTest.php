<?php

namespace Tests\Feature\Portal\Permissions;

use App\Models\Permission;
use Tests\TestCase;

class CreatePermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_permissions(): void
    {
        $data = [
            'name' => 'Test',
            'code' => 'test.test',
            'endpoint' => 'test/test',
            'method' => 'GET',
            'group' => 'Test',
            'type' => 'api'
        ];
        $response = $this->portal()->post('/portal/permissions', $data);

        $response->assertOk();
        $this->assertDatabaseHas(Permission::class, $data);
        $response->assertJson([
            'permission' => [
                'name' => 'Test'
            ]
        ]);
    }
}

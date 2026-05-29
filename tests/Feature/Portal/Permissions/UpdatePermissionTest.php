<?php

namespace Tests\Feature\Portal\Permissions;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdatePermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_update_permission(): void
    {
        $permission = Permission::factory()->create();
        $data = [
            'name' => 'Test',
            'code' => 'test.test',
            'endpoint' => 'test/test',
            'method' => 'GET',
            'group' => 'Test',
            'type' => 'api'
        ];
        $response = $this->portal()->patch('/portal/permissions/' . $permission->getKey(), $data);

        $response->assertOk();
        $this->assertDatabaseHas(Permission::class, $data);
        $response->assertJson([
            'permission' => [
                'name' => 'Test'
            ]
        ]);
    }
}

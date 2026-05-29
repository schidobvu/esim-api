<?php

namespace Tests\Feature\Portal\Permissions;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetPermissionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_permission(): void
    {
        $permission = Permission::factory()->create();

        $response = $this->portal()->get('/portal/permissions/' . $permission->getKey());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'permission' =>
                [
                    'id', 'name', 'type', 'code', 'endpoint','creator','roles'
                ]
        ]);
    }
}

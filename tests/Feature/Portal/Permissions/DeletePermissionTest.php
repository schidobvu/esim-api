<?php

namespace Tests\Feature\Portal\Permissions;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeletePermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_delete_permission(): void
    {
        $permission = Permission::factory()->create();

        $response = $this->portal()->delete('/portal/permissions/' . $permission->getKey());

        $response->assertOk();
        $this->assertDatabaseMissing(Permission::class, $permission->toArray());
    }
}

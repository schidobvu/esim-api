<?php

namespace Tests\Feature\Portal\PortalUsers;

use App\Models\PortalUser;
use Tests\TestCase;

class BlockPortalUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_block_portal_user(): void
    {
        $user = PortalUser::factory()->create();

        $response = $this->portal()->patch(sprintf('/portal/portal-users/%s/block', $user->getKey()));

        $response->assertOk();
        $response->assertJson([
            'portal_user' => [
                'blocked' => true
            ]
        ]);
    }
}

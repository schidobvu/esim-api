<?php

namespace Tests\Feature\Portal\PortalUsers;

use App\Models\PortalUser;
use Tests\TestCase;

class UnblockPortalUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_unblock_portal_user(): void
    {
        $user = PortalUser::factory()->create(['blocked_at' => now()]);

        $response = $this->portal()->patch(sprintf('/portal/portal-users/%s/unblock', $user->getKey()));

        $response->assertOk();
        $response->assertJson([
            'portal_user' => [
                'blocked' => false
            ]
        ]);
    }
}

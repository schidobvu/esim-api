<?php

namespace Tests\Feature\Portal\PortalUsers;

use App\Models\PortalUser;
use Tests\TestCase;

class ListPortalUsersTest extends TestCase
{
    public function test_list_portal_users(): void
    {
        PortalUser::factory(50)->create();

        $response = $this->portal()->get('/portal/portal-users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'portal_users' => [
                'data' => [
                    [
                        'id', 'name', 'username', 'blocked_at', 'created_by', 'blocked'
                    ]
                ]
            ]

        ]);
    }

    public function test_list_portal_users_including_creator_and_permissions(): void
    {
        $login = $this->portal();

        PortalUser::factory(50)->create(['created_by' => $this->user->getKey()]);

        $response = $login->get('/portal/portal-users?include=creator,role.permissions');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'portal_users' => [
                'data' => [
                    [
                        'creator',
                        'role' => ['permissions']
                    ]
                ]
            ]
        ]);
    }

    public function test_filter_portal_users_with_username(): void
    {
        $login = $this->portal();
        $user = PortalUser::factory()->create(['username' => 'm.kampingo', 'created_by' => $this->user->getKey()]);
//        control
        PortalUser::factory(3)->create(['created_by' => $this->user->getKey(), 'created_at' => now()->subMonths(2)]);

        $response = $login->get('/portal/portal-users?filter[username]=' . $user->{'username'});

        $response->assertStatus(200);

        $response->assertJson([
            'portal_users' => [
                'data' => [
                    [
                        'username' => $user->{'username'}
                    ]
                ]
            ]
        ]);
    }
}

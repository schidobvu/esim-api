<?php

namespace Tests\Feature\Portal\Roles;

use App\Models\Role;
use Tests\TestCase;

class ListRolesTest extends TestCase
{
    public function test_list_roles(): void
    {
        Role::factory(50)->create();

        $response = $this->portal()->get('/portal/roles');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'roles' => [

                    [
                        'id', 'name', 'type', 'blocked_at', 'created_by', 'blocked'
                    ]

            ]
        ]);
    }

    public function test_list_roles_including_creator(): void
    {
        $login = $this->portal();
        Role::factory(50)->create(['created_by' => $this->user->getKey()]);

        $response = $login->get('/portal/roles?include=creator');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'roles' => [
                    [
                        'creator'
                    ]
            ]
        ]);
    }

    public function test_filter_clients_with_name(): void
    {
        $login = $this->portal();
        Role::factory()->create(['name' => 'Admin']);
//        control
        Role::factory(3)->create();

        $response = $login->get('/portal/roles?filter[name]=Admin');

        $response->assertStatus(200);

        $response->assertJsonCount(1, 'roles');
    }

    public function test_filter_roles_with_group(): void
    {
        $login = $this->portal();
        //        control
        Role::factory(5)->create(['type' => 'portal']);

        Role::factory(3)->create(['type' => 'app']);

        $response = $login->get('/portal/roles?filter[type]=app');

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'roles');
    }
}

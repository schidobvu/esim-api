<?php

namespace Tests;


use App\Models\Permission;
use App\Models\PortalUser;
use App\Models\Role;
use Database\Seeders\PortalPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\NewAccessToken;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public PortalUser|null $user;
    public NewAccessToken $userToken;

    protected function setUp(): void
    {
        parent::setUp();
    }


    protected function portal(string $username = 'c.kampingo'): self
    {
        /** @var Role $role */
        $role = Role::factory()->create();
        $this->user = PortalUser::factory()->create([
            'name' => 'Chimwemwe Kampingo',
            'username' => $username,
            'email' => 'Samson.Chidobvu@tnm.co.mw',
            'role_id' => $role->getKey(),
            'msisdn' => '265887364006',
        ]);
        $this->seed(PortalPermissionsSeeder::class);
        $role->permissions()->attach(Permission::where('type', 'portal')->get());

        $this->userToken = $this->user->createToken($username);
        $this->withHeaders([
            'Authorization' => sprintf('Bearer %s', $this->userToken->plainTextToken),
            'Accept' => 'application/json'
        ]);
        return $this;
    }
}

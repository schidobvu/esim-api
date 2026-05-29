<?php

namespace Database\Factories;

use App\Models\PortalUser;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortalUser>
 */
class PortalUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'username' => fake()->name,
            'name' => 'Chimwemwe Kampingo',
            'msisdn' => fake()->numerify('088#######'),
            'role_id' => Role::firstOrCreate([], collect(Role::factory()->make()->toArray())->except('blocked')->toArray()),
        ];
    }
}

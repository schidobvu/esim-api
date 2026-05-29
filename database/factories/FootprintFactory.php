<?php

namespace Database\Factories;

use App\Models\Footprint;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends Factory<Footprint>
 */
class FootprintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'endpoint' => $this->faker->slug(),
            'uri' => $this->faker->slug(),
            'method' => $this->faker->randomElement(['POST', 'GET', 'PATCH', 'DELETE']),
            'request' => json_encode(['item' => 2]),
            'response' => json_encode(['message' => 'Completed successfully']),
            'milliseconds' => $this->faker->randomDigitNotNull(),
            'status' => Response::HTTP_OK,
            'success' => true
        ];
    }
}

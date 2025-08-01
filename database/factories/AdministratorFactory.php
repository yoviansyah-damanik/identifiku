<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrator>
 */
class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Administrator',
            'place_of_birth' => fake()->city,
            'address' => fake()->address,
            'date_of_birth' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),
            'gender' => ['M', 'F'][rand(0, 1)],
        ];
    }
}

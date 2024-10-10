<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $school = School::inRandomOrder()->first();
        return [
            'name' => fake()->name,
            'nisn' => fake()->numerify('########'),
            'nis' => fake()->numerify('########'),
            'place_of_birth' => fake()->city,
            'address' => fake()->address,
            'date_of_birth' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),
            'gender' => ['M', 'F'][rand(0, 1)],
            'school_id' => $school->id,
            'grade_level_id' => $school->educationLevel->grades()->inRandomOrder()->first()->id
        ];
    }
}

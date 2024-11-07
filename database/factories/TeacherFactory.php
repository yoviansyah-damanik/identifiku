<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            'nuptk' => fake()->numerify('################'),
            'place_of_birth' => fake()->city,
            'address' => fake()->address,
            'date_of_birth' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),
            'gender' => ['M', 'F'][rand(0, 1)],
            'subject' => ['Matematika', 'B. Indonesia', 'IPA', 'Olahraga', 'B. Inggris'][rand(0, 4)],
            'school_id' => $school->id,
        ];
    }
}

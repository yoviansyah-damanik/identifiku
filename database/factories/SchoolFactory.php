<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Support\Str;
use App\Models\SchoolStatus;
use App\Models\EducationLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $province_id = Region::province()->inRandomOrder()->first()->code;
        $regency_id = Region::regency($province_id)->inRandomOrder()->first()->code;
        $district_id = Region::district($regency_id)->inRandomOrder()->first()->code;
        $village_id = Region::village($district_id)->inRandomOrder()->first()->code;

        return [
            'name' => fake()->company,
            'npsn' => fake()->numerify('########'),
            'nss' => fake()->numerify('########'),
            'nis' => fake()->numerify('######'),
            'postal_code' => fake()->postcode,
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address,
            'province_id' => $province_id,
            'regency_id' => $regency_id,
            'district_id' => $district_id,
            'village_id' => $village_id,
            'school_status_id' => SchoolStatus::inRandomOrder()->first()->id,
            'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
            'token' => Str::random(8)
        ];
    }
}

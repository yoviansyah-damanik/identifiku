<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\School;
use Illuminate\Support\Str;
use App\Models\SchoolStatus;
use App\Models\EducationLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::factory()
            ->count(50)
            ->create();
    }
}

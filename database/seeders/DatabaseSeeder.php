<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            RegionSeeder::class,
            EducationLevelSeeder::class,
            SchoolStatusSeeder::class,
            UserSeeder::class,
            // QuestionSeeder::class,
            QuizPhaseSeeder::class,
            QuizCategorySeeder::class,
            QuizSeeder::class,
            ConfigurationSeeder::class,
            StudentClassSeeder::class,
        ]);
    }
}

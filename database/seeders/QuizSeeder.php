<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::factory()
            ->count(30)
            ->hasDetails()
            ->create();
    }
}

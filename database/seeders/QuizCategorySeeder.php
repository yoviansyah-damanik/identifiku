<?php

namespace Database\Seeders;

use App\Models\QuizCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizCategories = [
            [
                'name' => 'Formatif Awal',
                'description' => '-'
            ],
            [
                'name' => 'Peminatan',
                'description' => '-'
            ],
            [
                'name' => 'Rekomendasi Bidang Kuliah dan Kerja',
                'description' => '-'
            ],
        ];
        foreach ($quizCategories as $quizCategory) {
            QuizCategory::create($quizCategory);
        }
    }
}

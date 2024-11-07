<?php

namespace Database\Seeders;

use App\Models\QuizPhase;
use App\Models\QuizPhaseDetail;
use Illuminate\Database\Seeder;

class QuizPhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizPhases = [
            [
                'name' => 'Fase A',
                'description' => '-',
                'grades' => [1, 2]
            ],
            [
                'name' => 'Fase B',
                'description' => '-',
                'grades' => [3, 4]
            ],
            [
                'name' => 'Fase C',
                'description' => '-',
                'grades' => [5, 6]
            ],
            [
                'name' => 'Fase D',
                'description' => '-',
                'grades' => [7, 8]
            ],
            [
                'name' => 'Fase E',
                'description' => '-',
                'grades' => [9, 10]
            ],
            [
                'name' => 'Fase F',
                'description' => '-',
                'grades' => [11, 12]
            ],
        ];

        foreach ($quizPhases as $phase) {
            $newQuizPhase = QuizPhase::create(collect($phase)->except('grades')->toArray());

            foreach ($phase['grades'] as $grade) {
                QuizPhaseDetail::create([
                    'quiz_phase_id' => $newQuizPhase->id,
                    'grade_level_id' => $grade
                ]);
            }
        }
    }
}

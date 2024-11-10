<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\QuizType;
use App\Models\QuizPhase;
use App\Models\QuizCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'estimation_time' => rand(100, 120),
            'content_coverage' => fake()->paragraphs(asText: true),
            'assessment_objectives' => fake()->paragraphs(asText: true),
            'question_composition' => fake()->paragraphs(asText: true),
            'user_id' => User::role(['Superadmin', 'Administrator'])->inRandomOrder()->first()->id,
            'quiz_category_id' => QuizCategory::inRandomOrder()->first()->id,
            'quiz_phase_id' => QuizPhase::inRandomOrder()->first()->id,
            'type' => QuizType::cases()[rand(0, count(QuizType::cases()) - 1)]
        ];
    }
}

<?php

namespace App\Livewire\Main\Assessment;

use App\Models\Quiz;
use Livewire\Component;

class Show extends Component
{
    public Quiz $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz
            ->load(['phase', 'category', 'phase.grades', 'picture', 'groups' => fn($q) => $q->withCount('questions')]);
    }

    public function render()
    {
        $randomquizzes = Quiz::with(['phase', 'category', 'phase.grades', 'picture', 'groups' => fn($q) => $q->withCount('questions')])
            ->whereNot('id', $this->quiz->id)
            ->where(
                fn($q) => $q->where('quiz_category_id', $this->quiz->quiz_category_id)
                    ->orWhere('quiz_phase_id', $this->quiz->quiz_phase_id)
            )
            ->published()
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('pages.main.assessment.show', compact('randomquizzes'))
            ->title($this->quiz->name);
    }
}

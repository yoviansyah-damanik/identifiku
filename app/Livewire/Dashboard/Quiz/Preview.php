<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\QuizPhase;
use Livewire\Attributes\On;
use App\Models\QuizCategory;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Preview extends Component
{
    public Quiz $quiz;
    public $activeGroup;
    public $selectedQuizPhase;
    public $selectedQuizCategory;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->selectedQuizPhase = QuizPhase::where('id', $quiz->quiz_phase_id)->first()->load(['grades']);
        $this->selectedQuizCategory = QuizCategory::where('id', $quiz->quiz_category_id)->first();
    }

    public function render()
    {
        return view('pages.dashboard.quiz.preview')
            ->title(__('Preview') . ' - ' . $this->quiz->name);
    }

    #[On('setGroupActive')]
    public function setGroupActive($group = null)
    {
        if ($group)
            $this->activeGroup = $this->quiz->refresh()->groups
                ->where('id', $group)
                ->first()
                ->load(['questions', 'questions.answers']);
        else {
            if (!empty($this->activeGroup['questions'])) {
                $this->activeGroup = $this->activeGroup
                    ->load(['questions', 'questions.answers']);
            } else {
                $this->activeGroup = $this->activeGroup;
            }
        }
    }
}

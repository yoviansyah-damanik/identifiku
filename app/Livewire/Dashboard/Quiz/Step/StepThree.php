<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\QuizPhase;
use Livewire\Attributes\On;
use App\Models\QuizCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StepThree extends Component
{
    use LivewireAlert;

    public Quiz $quiz;
    public string $quizName;
    public string $quizType;
    public string $quizDescription;
    public string $estimationTime;
    public string $contentCoverage;
    public string $overview;
    public string $assessmentObjectives;

    public string $groupActive;

    public string $selectedQuizPhase;
    public string $selectedQuizCategory;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->quizName = $this->quiz->name;
        $this->quizType = $this->quiz->type;
        $this->estimationTime = $this->quiz->estimation_time;
        $this->contentCoverage = $this->quiz->content_coverage;
        $this->overview = $this->quiz->overview;
        $this->assessmentObjectives = $this->quiz->assessment_objectives;

        $this->selectedQuizPhase = QuizPhase::where('id', $this->quiz->quiz_phase_id)->first()->name;
        $this->selectedQuizCategory = QuizCategory::where('id', $this->quiz->quiz_category_id)->first()->name;
    }

    #[On('refreshQuizData')]
    public function refreshQuizData()
    {
        $this->groupActive = null;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-three');
    }
}

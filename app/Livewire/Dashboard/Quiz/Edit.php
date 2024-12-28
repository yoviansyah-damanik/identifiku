<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Livewire\Component;
use App\Helpers\QuizHelper;
use Livewire\Attributes\On;
use App\Models\QuestionType;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    use LivewireAlert;

    public Quiz $quiz;
    public ?string $groupActive = null;

    public array $quizTypes;
    public string $quizType;

    public string $quizName;
    public string $quizDescription;
    public string $estimationTime;
    public string $contentCoverage;
    public string $overview;
    public string $assessmentObjectives;

    public bool $isLoading = false;

    public array $quizCategories;
    public array $quizPhases;
    public string $quizCategory;
    public string $quizPhase;

    public string $selectedQuizPhase;
    public string $selectedQuizCategory;

    public array $questionTypes;
    public string $questionType;

    public $typeActive;

    public array $steps;

    public string $current;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->steps = QuizHelper::getQuizStep();
        $this->current = $this->steps[1]['step'];
    }

    public function render()
    {
        return view('pages.dashboard.quiz.edit')
            ->title(__('Edit :edit', ['edit' => __('Quiz')]));
    }

    #[On('setStep')]
    public function setStep($step)
    {
        if ($step == 3) {
            if (!$this->checkStepThree()) {
                return;
            }

            $this->current = 3;
        } else if ($step == 4) {
            if (!$this->checkStepThree()) {
                return;
            }

            if (!$this->checkStepFour()) {
                return;
            }

            $this->current = 4;
        } else {
            $this->current = $step;
        }
    }

    public function checkStepThree()
    {
        $this->quiz->refresh();
        $hasAssessmentRule = $this->quiz->assessmentRule;
        if (!$hasAssessmentRule) {
            $this->alert('warning', __('Please complete the assessment rules first'));
            $this->current = 2;
            return false;
        }

        // dd(
        //     $hasAssessmentRule->max_answer,
        //     $hasAssessmentRule->answers->count()
        // );
        $questionsAreComplete = $hasAssessmentRule->max_answer == $hasAssessmentRule->answers->count();

        if (!$questionsAreComplete) {
            $this->alert('warning', __('Please complete the assessment answer rules first'));
            $this->current = 2;
            return false;
        }

        if (in_array($hasAssessmentRule->type, ['group-calculation', 'calculation-2'])) {
            $questionsAreComplete = $hasAssessmentRule->answers->every(fn($item) => $item->score > 0);

            if (!$questionsAreComplete) {
                $this->alert('warning', __('Please complete the assessment answer rules first'));
                $this->current = 2;
                return false;
            }
        }

        if (!in_array($hasAssessmentRule->type, ['group-calculation'])) {
            $indicatorsAreComplete = $hasAssessmentRule->max_indicator == $hasAssessmentRule->indicators->count();

            if (!$indicatorsAreComplete) {
                $this->alert('warning', __('Please complete the assessment indicator rules first'));
                $this->current = 2;
                return false;
            }
        }

        return true;
    }

    public function checkStepFour()
    {
        $this->quiz->refresh();
        $hasGroups = $this->quiz->groups;
        if (!$hasGroups) {
            $this->alert('warning', __('Please add a question group first'));
            $this->current = 3;
            return false;
        }

        $hasQuestions = $this->quiz->groups->every(fn($q) => $q->questions->count() > 0);
        if (!$hasQuestions) {
            $this->alert('warning', __('Please add at least one question to each question group first'));
            $this->current = 3;
            return false;
        }

        if (in_array($this->quiz->assessmentRule->type, ['group-calculation'])) {
            $indicatorsAreComplete = $this->quiz->groups->count() == $this->quiz->assessmentRule->indicators->count();

            if (!$indicatorsAreComplete) {
                $this->alert('warning', __('Please complete the assessment indicator rules first'));
                $this->current = 3;
                return false;
            }
        }

        return true;
    }
}

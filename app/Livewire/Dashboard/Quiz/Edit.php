<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use App\Enums\QuizType;
use Livewire\Component;
use App\Models\QuizPhase;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Enums\QuestionTypes;
use App\Models\QuestionType;
use App\Models\QuizCategory;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
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
        $this->steps = GeneralHelper::getQuizStep();
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

        $detailsAreComplete = $hasAssessmentRule->max_item == $hasAssessmentRule->details->count();

        if (!$detailsAreComplete) {
            $this->alert('warning', __('Please complete the detailed assessment rules first'));
            $this->current = 2;
            return false;
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

        return true;
    }

    public function reorderQuizGroup($id, $position)
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $exist = QuestionType::where('quiz_id', $this->quiz->id)->where('id', $id)->first();

            if ($exist->order < $position + 1) {
                $exist->update(['order' => $position + 1]);
                QuestionType::where('quiz_id', $this->quiz->id)->whereNot('id', $id)
                    ->where('order', '<=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) {
                        $item->update(['order' => $key + 1]);
                    });
            } else {
                $exist->update(['order' => $position + 1]);
                QuestionType::where('quiz_id', $this->quiz->id)->whereNot('id', $id)
                    ->where('order', '>=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) use ($position) {
                        $item->update(['order' => ($position + 1) + $key + 1]);
                    });
            }

            DB::commit();
            $this->quiz->refresh();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

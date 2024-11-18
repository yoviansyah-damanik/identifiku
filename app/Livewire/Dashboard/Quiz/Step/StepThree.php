<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\QuizPhase;
use Livewire\Attributes\On;
use App\Models\QuizCategory;
use App\Models\QuestionGroup;
use Illuminate\Support\Facades\DB;
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

    public string $selectedQuizPhase;
    public string $selectedQuizCategory;

    public ?QuestionGroup $activeGroup;

    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz
            ->load(['assessmentRule', 'assessmentRule.details', 'groups', 'groups.questions', 'groups.questions.answers']);
        $this->quizName = $quiz->name;
        $this->quizType = $quiz->type;
        $this->estimationTime = $quiz->estimation_time;
        $this->contentCoverage = $quiz->content_coverage;
        $this->overview = $quiz->overview;
        $this->assessmentObjectives = $quiz->assessment_objectives;

        $this->selectedQuizPhase = QuizPhase::where('id', $quiz->quiz_phase_id)->first()->name;
        $this->selectedQuizCategory = QuizCategory::where('id', $quiz->quiz_category_id)->first()->name;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-three');
    }

    #[On('refreshQuizData')]
    public function refreshQuizData($group = null)
    {
        $this->quiz = $this->quiz->refresh()
            ->load(['assessmentRule', 'assessmentRule.details', 'groups', 'groups.questions', 'groups.questions.answers']);
        $this->setGroupActive($group);
    }

    #[On('setGroupActive')]
    public function setGroupActive($group = null)
    {
        if ($group)
            $this->activeGroup = $this->quiz->groups
                ->where('id', $group)
                ->first()
                ->load(['questions', 'questions.answers']);
        else
            $this->activeGroup = $this->activeGroup;
    }

    public function reorderQuizGroup($id, $position)
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $exist = QuestionGroup::where('id', $id)->first();

            if ($exist->order < $position + 1) {
                $exist->update(['order' => $position + 1]);
                QuestionGroup::where('quiz_id', $this->quiz->id)
                    ->whereNot('id', $id)
                    ->where('order', '<=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) {
                        $item->update(['order' => $key + 1]);
                    });
            } else {
                $exist->update(['order' => $position + 1]);
                QuestionGroup::where('quiz_id', $this->quiz->id)
                    ->whereNot('id', $id)
                    ->where('order', '>=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) use ($position) {
                        $item->update(['order' => ($position + 1) + $key + 1]);
                    });
            }

            DB::commit();
            $this->refreshQuizData();
            $this->isLoading = false;
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

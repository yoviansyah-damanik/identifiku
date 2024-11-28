<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\QuizPhase;
use Livewire\Attributes\On;
use App\Models\QuizCategory;
use App\Models\QuestionGroup;
use Livewire\Attributes\Isolate;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Isolate]
class StepThree extends Component
{
    use LivewireAlert;

    public Quiz $quiz;

    public string $selectedQuizPhase;
    public string $selectedQuizCategory;

    public ?QuestionGroup $activeGroup = null;

    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz
            ->load(['assessmentRule', 'assessmentRule.details', 'groups', 'groups.questions', 'groups.questions.answers']);

        $this->selectedQuizPhase = QuizPhase::where('id', $quiz->quiz_phase_id)->first()->name;
        $this->selectedQuizCategory = QuizCategory::where('id', $quiz->quiz_category_id)->first()->name;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-three');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="text-center">
            <!-- Loading spinner... -->
            <x-loading/>
        </div>
        HTML;
    }

    #[On('refreshQuizData')]
    public function refreshQuizData($group = null, $isResetActiveGroup = false)
    {
        // dd($group, $isResetActiveGroup);
        if ($isResetActiveGroup) {
            $this->reset('activeGroup');
        }

        $this->quiz->refresh()
            ->load(['assessmentRule', 'assessmentRule.details', 'groups', 'groups.questions', 'groups.questions.answers']);

        $this->setGroupActive($group);
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

        $this->dispatch('setActiveGroup', $this->activeGroup);
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

    public function reorderQuestion($id, $position)
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $exist = Question::where('id', $id)->first();

            if ($exist->order < $position + 1) {
                $exist->update(['order' => $position + 1]);
                Question::where('quiz_id', $this->quiz->id)
                    ->whereNot('id', $id)
                    ->where('order', '<=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) {
                        $item->update(['order' => $key + 1]);
                    });
            } else {
                $exist->update(['order' => $position + 1]);
                Question::where('quiz_id', $this->quiz->id)
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

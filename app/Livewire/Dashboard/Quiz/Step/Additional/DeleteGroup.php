<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuestionGroup;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeleteGroup extends Component
{
    use LivewireAlert;

    public Quiz $quiz;
    public ?QuestionGroup $group;

    public bool $isLoading = true;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.delete-group');
    }

    #[On('setDeleteGroup')]
    public function setDeleteGroup(QuestionGroup $group)
    {
        $this->isLoading = true;
        $this->group = $group;
        $this->isLoading = false;
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $this->group->delete();

            QuestionGroup::where('quiz_id', $this->quiz->id)
                ->orderBy('order', 'asc')
                ->each(function ($item, $key) {
                    $item->update(['order' => $key + 1]);
                });

            DB::commit();
            $this->isLoading = true;
            $this->dispatch('refreshQuizData', group: $this->group->id);
            $this->dispatch('toggle-delete-group-modal');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Group :group', ['group' => __('Question')])]));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }
}

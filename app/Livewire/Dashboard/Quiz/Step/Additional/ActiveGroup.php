<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;

class ActiveGroup extends Component
{
    use LivewireAlert;

    #[Reactive]
    public $activeGroup;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.active-group');
    }

    public function reorderQuestionGroup($id, $position)
    {
        DB::beginTransaction();
        try {
            $exist = Question::where('id', $id)->first();

            if ($exist->order < $position + 1) {
                $exist->update(['order' => $position + 1]);
                Question::where('question_group_id', $this->activeGroup->id)
                    ->whereNot('id', $id)
                    ->where('order', '<=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) {
                        $item->update(['order' => $key + 1]);
                    });
            } else {
                $exist->update(['order' => $position + 1]);
                Question::where('question_group_id', $this->activeGroup->id)
                    ->whereNot('id', $id)
                    ->where('order', '>=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) use ($position) {
                        $item->update(['order' => ($position + 1) + $key + 1]);
                    });
            }

            DB::commit();
            $this->dispatch('refreshQuizData', group: $this->activeGroup->id);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }
}

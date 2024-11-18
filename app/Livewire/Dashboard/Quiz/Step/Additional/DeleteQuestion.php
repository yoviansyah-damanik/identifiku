<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeleteQuestion extends Component
{
    use LivewireAlert;

    public ?Question $question;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.delete-question');
    }

    #[On('setDeleteQuestion')]
    public function setDeleteQuestion(Question $question)
    {
        $this->isLoading = true;
        $this->question = $question;
        $this->isLoading = false;
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $this->question->delete();

            Question::where('question_group_id', $this->question->group->id)
                ->orderBy('order', 'asc')
                ->each(function ($item, $key) {
                    $item->update(['order' => $key + 1]);
                });

            $this->reset('question');
            $this->isLoading = true;
            DB::commit();

            $this->dispatch('refreshGroupData');
            // $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-delete-question-modal');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Question')]));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }
}

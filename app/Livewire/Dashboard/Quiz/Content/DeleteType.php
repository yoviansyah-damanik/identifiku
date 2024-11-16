<?php

namespace App\Livewire\Dashboard\Quiz\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuestionType;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DeleteType extends Component
{
    use LivewireAlert;

    public Quiz $quiz;
    public QuestionType $type;
    public bool $isLoading = true;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.content.delete-type');
    }

    #[On('setDeleteType')]
    public function setDeleteType(QuestionType $type)
    {
        $this->isLoading = true;
        $this->type = $type;
        $this->isLoading = false;
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $this->type->delete();

            QuestionType::where('quiz_id', $this->quiz->id)
                ->orderBy('order', 'asc')
                ->each(function ($item, $key) {
                    $item->update(['order' => $key + 1]);
                });

            DB::commit();
            $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-delete-type-modal');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Type :type', ['type' => __('Quiz')])]));
            $this->isLoading = true;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }
}

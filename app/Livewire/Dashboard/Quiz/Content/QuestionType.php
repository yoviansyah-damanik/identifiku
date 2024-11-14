<?php

namespace App\Livewire\Dashboard\Quiz\Content;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\QuestionType as QuestionTypeModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class QuestionType extends Component
{
    use LivewireAlert;
    public QuestionTypeModel $type;

    public function mount(QuestionTypeModel $type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.content.question-type');
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $this->type->delete();

            QuestionTypeModel::orderBy('order', 'asc')
                ->each(function ($item, $key) {
                    $item->update(['order' => $key + 1]);
                });

            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Quiz')]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
        }
    }
}

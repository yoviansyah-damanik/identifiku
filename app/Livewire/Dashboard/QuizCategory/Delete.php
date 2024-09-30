<?php

namespace App\Livewire\Dashboard\QuizCategory;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuizCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['clearModal'];

    public QuizCategory $quizCategory;
    public bool $isLoading = true;

    #[On('setDeleteQuizCategory')]
    public function setDeleteQuizCategory(QuizCategory $quizCategory)
    {
        $this->quizCategory = $quizCategory
            ->loadCount('quizzes');
        $this->isLoading = false;
    }

    public function render()
    {
        return view('pages.dashboard.quiz-category.delete');
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function tes()
    {
        $this->isLoading = true;
        try {
            if ($this->quizCategory->quizzes_count > 0) {
                $this->alert('warning', __('Cannot delete data because there is still a :value :attribute associated with the data.', ['value' => $this->quizCategory->grades->count(), 'attribute' => $this->quizCategory->schools->count() > 1 ? __('Quiz Category') : __('Quiz Categories')]));
                $this->isLoading = false;
                return;
            }

            $this->quizCategory->delete();

            $this->dispatch('toggle-delete-quiz-category-modal');
            $this->dispatch('refreshQuizCategoryData');

            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Quiz Category')]));
            $this->isLoading = false;
            $this->reset();
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

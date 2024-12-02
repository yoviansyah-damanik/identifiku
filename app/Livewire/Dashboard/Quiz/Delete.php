<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    use LivewireAlert;
    public Quiz $quiz;

    public bool $isLoading = true;
    public function render()
    {
        return view('pages.dashboard.quiz.delete');
    }

    #[On('setDeleteQuiz')]
    public function setDeleteQuiz(Quiz  $quiz)
    {
        $this->isLoading = true;
        $this->quiz = $quiz
            ->loadCount(['assessments']);
        $this->isLoading = false;
    }

    public function delete()
    {
        try {
            if ($this->quiz->assessments->count() > 0) {
                $this->quiz->update([
                    'status' => 2
                ]);
                $this->quiz->delete();
            } else {
                $this->quiz->forceDelete();
            }

            $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-delete-quiz-modal');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Quiz')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

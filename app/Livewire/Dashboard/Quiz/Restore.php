<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Restore extends Component
{
    use LivewireAlert;
    public $quiz;

    public bool $isLoading = true;
    public function render()
    {
        return view('pages.dashboard.quiz.restore');
    }

    #[On('setRestoreQuiz')]
    public function setRestoreQuiz($quiz)
    {
        $this->isLoading = true;
        $this->quiz = Quiz::withTrashed()->whereSlug($quiz)->first()
            ->loadCount(['assessments']);
        $this->isLoading = false;
    }

    public function restore()
    {
        try {
            $this->quiz->update([
                'status' => 0
            ]);
            $this->quiz->restore();
            $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-restore-quiz-modal');
            $this->alert('success', __(':attribute restored successfully.', ['attribute' => __('Quiz')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

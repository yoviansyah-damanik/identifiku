<?php

namespace App\Livewire\Dashboard\QuizPhase;

use Livewire\Component;
use App\Models\QuizPhase;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['clearModal'];

    public QuizPhase $quizPhase;
    public bool $isLoading = true;

    #[On('setDeleteQuizPhase')]
    public function setDeleteQuizPhase(QuizPhase $quizPhase)
    {
        $this->quizPhase = $quizPhase
            ->loadCount('quizzes');
        $this->isLoading = false;
    }

    public function render()
    {
        return view('pages.dashboard.quiz-phase.delete');
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function delete()
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            if ($this->quizPhase->quizzes_count > 0) {
                $this->alert('warning', __('Cannot delete data because there is still a :value :attribute associated with the data.', ['value' => $this->quizPhase->grades->count(), 'attribute' => $this->quizPhase->schools->count() > 1 ? __('Quiz Phase') : __('Quiz Categories')]));
                $this->isLoading = false;
                return;
            }

            $this->quizPhase->details()->delete();
            $this->quizPhase->delete();

            DB::commit();

            $this->dispatch('toggle-delete-quiz-phase-modal');
            $this->dispatch('refreshQuizPhaseData');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Quiz Phase')]));
            $this->isLoading = false;
            $this->reset();
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

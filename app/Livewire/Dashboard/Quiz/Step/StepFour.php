<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\Isolate;

#[Isolate]
class StepFour extends Component
{
    public Quiz $quiz;
    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz
            ->load(['groups' => fn($q) => $q->withCount('questions')])
            ->loadCount('groups');
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-four');
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

    public function publish()
    {
        $this->isLoading = true;
        try {
            $this->quiz->update([
                'status' => 'published',
                'is_active' => true
            ]);

            return $this->redirectRoute('dashboard.quiz.show', $this->quiz);
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

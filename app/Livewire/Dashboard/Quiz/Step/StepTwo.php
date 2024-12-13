<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\Isolate;

#[Isolate]
class StepTwo extends Component
{
    public Quiz $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-two');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="text-center">
            <x-loading/>
        </div>
        HTML;
    }

    // #[On('refreshQuizData')]
    // public function refreshQuizData()
    // {
    //     $this->quiz = $this->quiz->refresh()
    //         ->load(['assessmentRule', 'assessmentRule.answers', 'assessmentRule.indicators']);
    // }

    // public function deleteIndicator(AssessmentIndicatorRule $indicator)
    // {
    //     try {
    //         $indicator->delete();
    //         $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Indicator Rule')]));
    //     } catch (\Exception $e) {
    //         $this->isLoading = false;
    //         $this->alert('error', $e->getMessage());
    //     } catch (\Throwable $e) {
    //         $this->isLoading = false;
    //         $this->alert('error', $e->getMessage());
    //     }
    // }

    // public function deleteQuestion(AssessmentAnswerRule $question)
    // {
    //     try {
    //         $question->delete();
    //         $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Answer Rule')]));
    //     } catch (\Exception $e) {
    //         $this->isLoading = false;
    //         $this->alert('error', $e->getMessage());
    //     } catch (\Throwable $e) {
    //         $this->isLoading = false;
    //         $this->alert('error', $e->getMessage());
    //     }
    // }
}

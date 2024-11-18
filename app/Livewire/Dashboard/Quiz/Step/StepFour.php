<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use Livewire\Component;

class StepFour extends Component
{
    public Quiz $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-four');
    }
}

<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\On;
use Livewire\Component;

class Add extends Component
{
    public Quiz $quiz;
    public function render()
    {
        return view('pages.dashboard.quiz.add');
    }

    #[On('setAddQuiz')]
    public function setAddQuiz(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }
}

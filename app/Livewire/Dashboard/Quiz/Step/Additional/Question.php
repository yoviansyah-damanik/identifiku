<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Question extends Component
{
    #[Reactive]
    public $question;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.question');
    }
}

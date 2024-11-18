<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class QuestionGroup extends Component
{
    #[Reactive]
    public $group;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.question-group');
    }
}

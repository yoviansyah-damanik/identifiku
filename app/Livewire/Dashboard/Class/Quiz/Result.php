<?php

namespace App\Livewire\Dashboard\Class\Quiz;

use Livewire\Component;

class Result extends Component
{
    public $result;
    public function render()
    {
        return view('pages.dashboard.class.quiz.result');
    }
}

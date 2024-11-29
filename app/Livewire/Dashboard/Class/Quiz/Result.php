<?php

namespace App\Livewire\Dashboard\Class\Quiz;

use App\Models\Assessment;
use Livewire\Component;

class Result extends Component
{
    public $result;
    public Assessment $assessment;

    public function mount(Assessment $assessment)
    {
        $this->assessment = $assessment;
    }
    public function render()
    {
        return view('pages.dashboard.class.quiz.result');
    }
}

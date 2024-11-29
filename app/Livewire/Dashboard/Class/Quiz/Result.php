<?php

namespace App\Livewire\Dashboard\Class\Quiz;

use App\Models\Assessment;
use Livewire\Attributes\On;
use Livewire\Component;

class Result extends Component
{
    public $result;
    public Assessment $assessment;

    #[On('setActiveAssessment')]
    public function setActiveAssessment(Assessment $assessment)
    {
        $this->assessment = $assessment->load([
            'result',
            'result.details',
            'details'
        ]);
        $this->dispatch('chartInit');
    }

    public function render()
    {
        return view('pages.dashboard.class.quiz.result');
    }
}

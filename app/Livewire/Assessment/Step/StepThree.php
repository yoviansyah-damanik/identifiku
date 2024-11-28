<?php

namespace App\Livewire\Assessment\Step;

use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\Isolate;

#[Isolate]
class StepThree extends Component
{
    public Assessment $assessment;

    public function mount(Assessment $assessment)
    {
        $this->assessment = $assessment
            ->load(
                'quiz',
                'quiz.groups',
                'quiz.groups.questions',
                'quiz.groups.questions.answers',
            );
    }

    public function render()
    {
        return view('pages.assessment.step.step-three');
    }
}

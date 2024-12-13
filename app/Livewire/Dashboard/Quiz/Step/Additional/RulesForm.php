<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\AssessmentRule;
use Livewire\Attributes\On;
use Livewire\Component;

class RulesForm extends Component
{
    protected $listeners = ['refreshQuizData' => '$refresh'];

    public ?AssessmentRule $rule;

    public bool $isLoading = false;
    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.rules-form');
    }

    #[On('setRule')]
    public function setRule(AssessmentRule $rule)
    {
        $this->isLoading = true;
        $this->rule = $rule;
        $this->isLoading = false;
    }
}

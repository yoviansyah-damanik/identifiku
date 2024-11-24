<?php

namespace App\Livewire\Assessment;

use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\Layout;

#[Layout('layouts.assessment')]
class Play extends Component
{
    public Assessment $assessment;

    public function mount(Assessment $assessment)
    {
        $this->authorize('view', $assessment);
        $this->assessment = $assessment->load([
            'quiz',
            'quiz.groups',
            'quiz.groups.questions'
        ]);
    }

    public function render()
    {
        return view('pages.assessment.play')
            ->title(__('Assessment') . ' - ' . $this->assessment->quiz->name);
    }
}

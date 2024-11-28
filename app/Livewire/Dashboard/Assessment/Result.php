<?php

namespace App\Livewire\Dashboard\Assessment;

use App\Models\Assessment;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.dashboard')]
class Result extends Component
{
    public Assessment $assessment;

    public function mount(Assessment $assessment)
    {
        $this->authorize('result', $assessment);

        $this->assessment = $assessment
            ->load([
                'student',
                'student.school',
                'quiz',
                'class',
                'quiz.assessments',
                'quiz.phase',
                'quiz.category',
                'quiz.phase.grades',
                'quiz.picture',
                'quiz.groups' => fn($q) => $q->withCount('questions'),
                'result',
                'result.details'
            ]);
    }

    public function render()
    {
        return view('pages.dashboard.assessment.result')
            ->title(__('Assessment Result'));
    }
}

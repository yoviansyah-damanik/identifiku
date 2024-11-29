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
                'class.assessments',
                'class.assessments.result',
                'class.assessments.result.details',
                'class.assessments.student',
                'quiz.assessments',
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

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

        if ($this->assessment->result->status == 'done')
            $this->assessment = $assessment
                ->load([
                    'student',
                    'student.school',
                    'quiz',
                    'class',
                    'class.assessments' => fn($q) => $q->where('quiz_id', $this->assessment->quiz->id)
                        ->whereNot('student_id', $this->assessment->student_id),
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

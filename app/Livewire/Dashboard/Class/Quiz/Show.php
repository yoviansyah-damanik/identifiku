<?php

namespace App\Livewire\Dashboard\Class\Quiz;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Assessment;
use App\Models\StudentClass;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    use WithPagination, WithoutUrlPagination;

    public StudentClass $class;
    public Quiz $quiz;

    public string $activeAssessment;

    public function mount(StudentClass $class, Quiz $quiz)
    {
        $this->class = $class;
        $this->quiz = $quiz;
    }

    public function render()
    {
        $assessments = Assessment::where('quiz_id', $this->quiz->id)
            ->with(['student'])
            ->where('student_class_id', $this->class->id)
            ->orderBy('status', 'asc')
            ->simplePaginate(5);

        return view('pages.dashboard.class.quiz.show', compact('assessments'))
            ->title($this->class->name);
    }

    public function setAssessmentActive(Assessment $assessment)
    {
        $this->dispatch('setActiveAssessment', $assessment->id);
        $this->activeAssessment = $assessment->id;
    }
}

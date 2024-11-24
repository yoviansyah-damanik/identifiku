<?php

namespace App\Livewire\Dashboard\Class\Quiz;

use App\Models\Assessment;
use App\Models\Quiz;
use Livewire\Component;
use App\Models\StudentClass;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component
{

    public StudentClass $class;
    public Quiz $quiz;
    public Collection $assessments;

    public function mount(StudentClass $class, Quiz $quiz)
    {
        $this->class = $class;
        $this->quiz = $quiz;

        $this->assessments = Assessment::where('quiz_id', $quiz->id)
            ->where('student_class_id', $class->id)
            ->get();
    }

    public function render()
    {
        return view('pages.dashboard.class.quiz.show')
            ->title($this->class->name);
    }
}

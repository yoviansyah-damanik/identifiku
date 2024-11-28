<?php

namespace App\Livewire\Dashboard\StudentClass;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\StudentClass;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    use LivewireAlert;
    public StudentClass $class;

    #[Url]
    public string $activeQuizUrl = '';

    public function mount(StudentClass $class)
    {
        $this->class = $class->load([
            'quizzes',
            'quizzes.assessments'
        ]);
        $this->authorize('view', $class);
    }

    public function render()
    {
        return view('pages.dashboard.student-class.show')
            ->title($this->class->name);
    }

    public function setQuizActive(Quiz $quiz)
    {
        $this->dispatch('setActiveQuiz', $quiz->slug);
        $this->activeQuizUrl = $quiz->slug;
    }
}

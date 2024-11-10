<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    public Quiz $quiz;
    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        if (!auth()->user()->isAdmin)
            if (!$quiz->is_active) {
                return $this->redirectRoute('dashboard.quiz.available');
            }
    }

    public function render()
    {
        return view('pages.dashboard.quiz.show')
            ->title($this->quiz->name);
    }
}

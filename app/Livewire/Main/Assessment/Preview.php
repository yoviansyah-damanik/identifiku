<?php

namespace App\Livewire\Main\Assessment;

use App\Models\Quiz;
use Livewire\Component;

class Preview extends Component
{
    public Quiz $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.main.assessment.preview')
            ->title(__('Preview') . ' - ' . $this->quiz->name);
    }
}

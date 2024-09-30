<?php

namespace App\Livewire\Dashboard\QuestionType;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public function render()
    {
        return view('pages.dashboard.question-type.index');
    }
}

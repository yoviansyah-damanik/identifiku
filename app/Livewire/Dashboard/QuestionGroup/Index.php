<?php

namespace App\Livewire\Dashboard\QuestionGroup;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public function render()
    {
        return view('pages.dashboard.question-group.index');
    }
}

<?php

namespace App\Livewire\Dashboard\Quiz;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Preview extends Component
{
    public function render()
    {
        return view('pages.dashboard.quiz.preview');
    }
}

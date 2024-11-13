<?php

namespace App\Livewire\Dashboard\Assessment;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Students extends Component
{
    public function render()
    {
        return view('pages.dashboard.assessment.students');
    }
}

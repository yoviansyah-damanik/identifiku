<?php

namespace App\Livewire\Dashboard\Assessment;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class History extends Component
{
    public function render()
    {
        return view('pages.dashboard.assessment.history')
            ->title(__('Assessment History'));
    }
}

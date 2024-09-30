<?php

namespace App\Livewire\Dashboard\Assessment;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public function render()
    {
        return view('pages.dashboard.assessment.index')
            ->title(__('Assessment'));
    }
}

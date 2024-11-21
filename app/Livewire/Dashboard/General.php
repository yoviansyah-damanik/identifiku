<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class General extends Component
{
    public function render()
    {
        return view('pages.dashboard.general');
    }
}

<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public function render()
    {
        return view('pages.dashboard.index')
            ->title(__('Dashboard'));
    }
}

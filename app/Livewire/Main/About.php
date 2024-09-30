<?php

namespace App\Livewire\Main;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('pages.main.about')
            ->title(__('About'));
    }
}

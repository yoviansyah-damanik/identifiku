<?php

namespace App\Livewire\Main;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('pages.main.index')
            ->title(__('Home Page'));
    }
}

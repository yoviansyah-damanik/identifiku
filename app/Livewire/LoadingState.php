<?php

namespace App\Livewire;

use Livewire\Component;

class LoadingState extends Component
{
    public bool $isLoading = false;

    public function render()
    {
        return view('pages.loading-state');
    }
}

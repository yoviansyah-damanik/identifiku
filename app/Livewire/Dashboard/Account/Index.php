<?php

namespace App\Livewire\Dashboard\Account;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public array $choices;
    public string $choice;

    public function mount()
    {
        $this->choices = ['user', 'account'];
        $this->choice = $this->choices[0];
    }

    public function render()
    {
        return view('pages.dashboard.account.index')
            ->title(__('Account Settings'));
    }
}

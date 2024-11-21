<?php

namespace App\Livewire\Dashboard\Account;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public array $choices;
    public string $choice;

    public function mount()
    {
        $this->choices = [
            Str::lower(auth()->user()->roleName == 'Superadmin' ? 'Administrator' : auth()->user()->roleName),
            'user',
            'password'
        ];

        $this->choice = $this->choices[0];
    }

    public function render()
    {
        return view('pages.dashboard.account.index')
            ->title(__('Account Settings'));
    }
}

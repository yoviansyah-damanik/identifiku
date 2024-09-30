<?php

namespace App\Livewire\Dashboard\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class User extends Component
{
    public string $username;
    public string $email;

    public function mount()
    {
        $userData = Auth::user();
        $this->username = $userData->username;
        $this->email = $userData->email;
    }

    public function render()
    {
        return view('pages.dashboard.account.user');
    }
}

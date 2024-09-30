<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public string $menu;

    public function mount($menu)
    {
        $this->menu = $menu;
    }

    public function render()
    {
        return view('pages.auth.logout');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return $this->redirectIntended(route('login'), navigate: false);
    }
}

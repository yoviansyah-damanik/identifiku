<?php

namespace App\View\Components\Dashboard\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class User extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $navigations = [
            [
                'title' => __('Home'),
                'icon' => 'i-fluent-emoji-flat-house',
                'url' => route('home'),
            ],
            [
                'title' => __('Account Settings'),
                'icon' => 'i-fluent-emoji-flat-identification-card',
                'url' => route('dashboard.account'),
            ],
        ];

        return view('components.dashboard.header.user', compact('navigations'));
    }
}

<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
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
                'url' => route('home')
            ],
            [
                'title' => __('Assessment'),
                'url' => route('assessment')
            ],
            [
                'title' => __('About'),
                'url' => route('about')
            ],
            [
                'title' => __('Login'),
                'url' => route('login')
            ],
            [
                'title' => __('Registration'),
                'url' => route('registration')
            ]
        ];

        return view('components.main.footer', compact('navigations'));
    }
}

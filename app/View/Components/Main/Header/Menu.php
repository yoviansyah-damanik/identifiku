<?php

namespace App\View\Components\Main\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

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
                'title' => __('Articles'),
                'url' => route('article')
            ],
            [
                'title' => __('About'),
                'url' => route('about')
            ]
        ];
        return view('components.main.header.menu', compact('navigations'));
    }
}
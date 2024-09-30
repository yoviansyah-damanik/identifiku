<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public array $navigations;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->navigations = [
            [
                'title' => __('Dashboard'),
                'url' => route('dashboard'),
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.header');
    }
}

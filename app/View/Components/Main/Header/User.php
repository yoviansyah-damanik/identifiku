<?php

namespace App\View\Components\Main\Header;

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
        $navigations = [];
        if (auth()->check()) {
            if (auth()->user()->isStudent) {
                $navigations = [
                    [
                        'title' => __('Dashboard'),
                        'icon' => 'i-fluent-emoji-flat-antenna-bars',
                        'url' => route('dashboard'),
                    ],
                    [
                        'title' => __('Assessment History'),
                        'icon' => 'i-fluent-emoji-flat-bookmark-tabs',
                        'url' => route('dashboard.assessment-history'),
                    ],
                    [
                        'title' => __('Account Settings'),
                        'icon' => 'i-fluent-emoji-flat-identification-card',
                        'url' => route('dashboard.account'),
                    ],
                ];
            } else {
                $navigations = [
                    [
                        'title' => __('Dashboard'),
                        'icon' => 'i-fluent-emoji-flat-antenna-bars',
                        'url' => route('dashboard'),
                    ],
                    [
                        'title' => __('Account Settings'),
                        'icon' => 'i-fluent-emoji-flat-identification-card',
                        'url' => route('dashboard.account'),
                    ],
                ];
            }
        }
        return view('components.main.header.user', compact('navigations'));
    }
}

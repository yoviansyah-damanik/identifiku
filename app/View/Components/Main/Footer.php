<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Vite;

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

        $supporters = [
            ['image_path' => Vite::image('lldikti1.png'), 'alt' => 'LLDIKTI 1 Logo'],
            ['image_path' => Vite::image('drtpm-bima.png'), 'alt' => 'DRTPM Bima Logo'],
            ['image_path' => Vite::image('kampus-merdeka.png'), 'alt' => 'Kampus Merdeka Logo'],
            ['image_path' => Vite::image('ugn.png'), 'alt' => 'UGN Logo'],
        ];

        return view('components.main.footer', compact('navigations', 'supporters'));
    }
}

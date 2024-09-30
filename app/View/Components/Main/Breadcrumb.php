<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $breadcrumbs;

    /**
     * Create a new component instance.
     */
    public function __construct(
        array $breadcrumbs
    ) {
        $this->breadcrumbs = [
            [
                'title' => __('Home'),
                'url' => route('home')
            ],
            ...$breadcrumbs
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.breadcrumb');
    }
}

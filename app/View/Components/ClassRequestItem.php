<?php

namespace App\View\Components;

use App\Models\ClassRequest;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClassRequestItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ClassRequest $request
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.class-request-item');
    }
}

<?php

namespace App\View\Components\Assessment\Helper;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dichotomous extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $questionType
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.assessment.helper.dichotomous');
    }
}

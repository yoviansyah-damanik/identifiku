<?php

namespace App\View\Components\Assessment\Step\Summative;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Group extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $groups,
        public $questionActive,
        public $result
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.assessment.step.summative.group');
    }
}

<?php

namespace App\View\Components\Assessment\Result;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimpleSummative extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $assessment
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.assessment.result.simple-summative');
    }
}

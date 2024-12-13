<?php

namespace App\View\Components\Assessment\Result;

use Closure;
use App\Models\Assessment;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Calculation2 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Assessment $assessment
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.assessment.result.calculation2');
    }
}

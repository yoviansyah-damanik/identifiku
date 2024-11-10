<?php

namespace App\View\Components;

use App\Models\Quiz;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuizBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Quiz $quiz,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.quiz-box');
    }
}

<?php

namespace App\Livewire\Dashboard\Question;

use App\Models\Question;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    public function render()
    {
        $questions = Question::with('category', 'type')
            ->paginate();

        return view('pages.dashboard.question.index', compact('questions'));
    }
}

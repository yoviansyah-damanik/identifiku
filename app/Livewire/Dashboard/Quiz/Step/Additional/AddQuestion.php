<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;

class AddQuestion extends Component
{
    public string $name;
    public string $description;

    public bool $isLoading = false;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.add-question');
    }
}

<?php

namespace App\Livewire\Dashboard\StudentClass;

use Livewire\Component;
use App\Models\StudentClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    use LivewireAlert;
    public StudentClass $class;

    public function mount(StudentClass $class)
    {
        $this->authorize('view', $class);

        if (auth()->user()->hasClasses)
            $this->class = $class;
    }

    public function render()
    {
        return view('pages.dashboard.student-class.show')
            ->title($this->class->name);
    }
}

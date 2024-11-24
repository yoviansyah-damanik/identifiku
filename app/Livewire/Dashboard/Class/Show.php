<?php

namespace App\Livewire\Dashboard\Class;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\StudentClass;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    protected $listeners = ['resetClassData'];

    use WithPagination;
    public StudentClass $class;
    public string $tabActive;
    public array $tabs;

    public function mount(StudentClass $class)
    {
        $this->class = $class;
        $this->setTabs();
        $this->tabActive = $this->tabs[1]['value'];
    }

    public function setTabs()
    {
        $this->tabs = [
            [
                'value' => 'overview',
                'title' => __(Str::headline('Overview')),
            ],
            [
                'value' => 'quizzes',
                'title' => __(Str::headline('Quizzes')),
                'badge' => $this->class->quizzes()->count()
            ],
            [
                'value' => 'students',
                'title' => __(Str::headline('Students')),
                'badge' => $this->class->students()->count()
            ],
        ];
    }

    public function resetClassData()
    {
        // $this->class = $this->class->refresh();
        $this->setTabs();
    }

    public function render()
    {
        $data = null;
        if ($this->tabActive == 'overview')
            $data = $this->class
                ->loadCount(['students', 'quizzes', 'assessments']);

        if ($this->tabActive == 'quizzes')
            $data = $this->class->quizzes()
                ->withCount('assessments')
                // ->with('')
                ->paginate(10);

        if ($this->tabActive == 'students')
            $data = $this->class->students()
                ->with('grade', 'hasClasses')
                ->paginate(10);

        return view('pages.dashboard.class.show', compact('data'))
            ->title($this->class->name);
    }
}

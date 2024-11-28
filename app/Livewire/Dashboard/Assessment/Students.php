<?php

namespace App\Livewire\Dashboard\Assessment;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Assessment;
use App\Models\StudentClass;
use Livewire\Attributes\Url;
use App\Helpers\GeneralHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Students extends Component
{
    use LivewireAlert;
    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public bool $isLoading = false;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        // dd(auth()->user()->teacher->classes);
        $assessments = Assessment::with([
            'student',
            'student.school',
            'quiz',
            'quiz.phase',
            'quiz.category',
            'quiz.phase.grades',
            'quiz.picture',
            'quiz.groups' => fn($q) => $q->withCount('questions'),
            'class'
        ])
            ->whereHas('quiz', fn($q) => $q->whereAny(['name'], 'like', "%$this->search%"))
            ->when(
                auth()->user()->roleName == 'Teacher',
                fn($q) => $q
                    ->whereHas('class', fn($q) => $q->whereIn('student_class_id', auth()->user()->teacher->classes->pluck('id')->toArray()))
            )
            ->when(
                auth()->user()->roleName == 'School',
                fn($q) => $q
                    ->whereHas('class', fn($q) => $q->whereIn('student_class_id', auth()->user()->school->classes->pluck('id')->toArray()))
            )
            ->orderBy('status', 'asc')
            ->paginate($this->perPage);
        // dd($assessments);

        return view('pages.dashboard.assessment.students', compact('assessments'))
            ->title(__('Student Assessments'));
    }
}

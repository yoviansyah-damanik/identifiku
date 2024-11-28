<?php

namespace App\Livewire\Dashboard\Assessment;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Helpers\GeneralHelper;
use App\Models\ClassHasQuiz;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public string $activeAssessment;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        $hasQuizzes = ClassHasQuiz::with([
            'class',
            'quiz',
            'quiz.assessments'
        ])
            ->whereHas('quiz', fn($q) => $q->whereAny(['name'], 'like', "%$this->search%"))
            ->whereIn('student_class_id', auth()->user()->student->hasClasses->pluck('student_class_id')->toArray())
            ->latest()
            ->simplePaginate($this->perPage);

        return view('pages.dashboard.assessment.index', compact('hasQuizzes'))
            ->title(__('Assessment'));
    }

    public function setAssessmentActive($id)
    {
        $this->activeAssessment = $id;
        $this->dispatch('setActiveAssessment', $id);
    }
}

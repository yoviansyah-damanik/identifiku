<?php

namespace App\Livewire\Dashboard\QuizPhase;

use Livewire\Component;
use App\Models\QuizPhase;
use App\Models\GradeLevel;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshQuizPhaseData' => '$refresh'];

    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public array $gradeLevels;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        $this->gradeLevels = GradeLevel::with('educationLevel')->get()
            ->map(fn($q) => [
                'value' => $q->id,
                'label' => $q->name . ' (' . $q->educationLevel->name . ')',
            ])->toArray();
    }

    public function render()
    {
        $quizPhases = QuizPhase::with('grades')->withCount('quizzes')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('pages.dashboard.quiz-phase.index', compact('quizPhases'))
            ->title(__('Quiz Phase'));
    }
}

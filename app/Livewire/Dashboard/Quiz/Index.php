<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\QuizPhase;
use App\Models\QuizCategory;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;
    protected $listeners = ['refreshQuizData' => '$refresh'];

    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public string $quizCategorySearch = '';
    public array $quizCategories;
    public string $quizCategory = '';

    public string $quizPhaseSearch = '';
    public array $quizPhases;
    public string $quizPhase = '';

    public array $statuses;

    #[Url]
    public string $status;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        $this->setQuizCategories();
        $this->setQuizPhases();

        $this->statuses = [
            [
                'title' => __('All'),
                'value' => 'all'
            ],
            [
                'title' => __('Draft'),
                'value' => 'draft'
            ],
            [
                'title' => __('Published'),
                'value' => 'published'
            ],
        ];
        $this->status = empty($this->status) ? $this->statuses[0]['value'] : $this->status;
    }

    public function render()
    {
        $quizzes = Quiz::with(['phase', 'category', 'phase.grades', 'picture', 'groups' => fn($q) => $q->withCount('questions')])
            ->withCount('hasClasses')
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->quizCategory, fn($q) => $q->where('quiz_category_id', $this->quizCategory))
            ->when($this->quizPhase, fn($q) => $q->where('quiz_phase_id', $this->quizPhase))
            ->latest()
            ->orderBy('status', 'asc')
            ->orderBy('name', 'asc')
            ->when($this->status != 'all', fn($q) => $q->when(
                $this->status == 'published',
                fn($r) => $r->published(),
                fn($r) => $r->draft(),
            ))
            ->withTrashed()
            ->paginate($this->perPage);

        return view('pages.dashboard.quiz.index', compact('quizzes'))
            ->title(__('Quiz'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }

    public function setQuizCategories()
    {
        $this->quizCategories = QuizCategory::where('name', 'like', '%' . $this->quizCategorySearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($quizCategory) => [
                'title' => $quizCategory->name,
                'value' => $quizCategory->id,
                'description' => $quizCategory->description,
            ])
            ->toArray();
    }

    public function setQuizPhases()
    {
        $this->quizPhases = QuizPhase::with('grades')
            ->where('name', 'like', '%' . $this->quizPhaseSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($quizPhase) => [
                'title' => $quizPhase->name,
                'value' => $quizPhase->id,
                'description' => $quizPhase->grades->pluck('name')->join(', '),
            ])
            ->toArray();
    }

    public function setSearchQuizCategory(QuizCategory $quizCategory)
    {
        $this->quizCategory = $quizCategory->id;
        $this->dispatch('setTitleQuizCategory', $quizCategory->name);
    }

    public function setSearchQuizCategorySearch($data)
    {
        $this->quizCategorySearch = $data;
        $this->setQuizCategories();
    }

    public function setValueQuizCategorySearch($data)
    {
        $this->quizCategory = $data;
        $this->resetPage();
    }

    public function resetValueQuizCategorySearch()
    {
        $this->resetPage();
        $this->reset('quizCategory', 'quizCategorySearch');
    }

    public function setSearchQuizPhase(QuizPhase $quizPhase)
    {
        $this->quizPhase = $quizPhase->id;
        $this->dispatch('setTitleQuizPhase', $quizPhase->name);
    }

    public function setSearchQuizPhaseSearch($data)
    {
        $this->quizPhaseSearch = $data;
        $this->setQuizPhases();
    }

    public function setValueQuizPhaseSearch($data)
    {
        $this->quizPhase = $data;
        $this->resetPage();
    }

    public function resetValueQuizPhaseSearch()
    {
        $this->resetPage();
        $this->reset('quizPhase', 'quizPhaseSearch');
    }
}

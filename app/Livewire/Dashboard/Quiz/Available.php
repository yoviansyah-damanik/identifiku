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
class Available extends Component
{
    use WithPagination;

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

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        $this->setQuizCategories();
        $this->setQuizPhases();
    }

    public function render()
    {
        $quizzes = Quiz::with(['phase', 'category', 'phase.grades', 'picture', 'groups' => fn($q) => $q->withCount('questions')])
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->quizCategory, fn($q) => $q->where('quiz_category_id', $this->quizCategory))
            ->when($this->quizPhase, fn($q) => $q->where('quiz_phase_id', $this->quizPhase))
            ->published()
            ->paginate($this->perPage);

        return view('pages.dashboard.quiz.available', compact('quizzes'))
            ->title(__('Available Quiz'));
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

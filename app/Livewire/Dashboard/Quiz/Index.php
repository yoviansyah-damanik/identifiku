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

    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public string $quizCategorySearch = '';
    public string $quizCategory = '';
    public string $quizPhaseSearch = '';
    public string $quizPhase = '';

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        $quizCategories = QuizCategory::where('name', 'like', '%' . $this->quizCategorySearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($quizCategory) => [
                'title' => $quizCategory->name,
                'value' => $quizCategory->id,
                'description' => $quizCategory->description,
            ])
            ->toArray();

        $quizPhases = QuizPhase::with('grades')
            ->where('name', 'like', '%' . $this->quizPhaseSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($quizPhase) => [
                'title' => $quizPhase->name,
                'value' => $quizPhase->id,
                'description' => $quizPhase->grades->pluck('name')->join(', '),
            ])
            ->toArray();

        $quizzes = Quiz::with('phase', 'category', 'phase.grades', 'picture', 'types', 'types.questions')
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->quizCategory, fn($q) => $q->where('quiz_category_id', $this->quizCategory))
            ->when($this->quizPhase, fn($q) => $q->where('quiz_phase_id', $this->quizPhase))
            ->paginate($this->perPage);

        return view('pages.dashboard.quiz.index', compact('quizzes', 'quizPhases', 'quizCategories'))
            ->title(__('Quiz'));
    }

    public function setSearchQuizCategory(QuizCategory $quizCategory)
    {
        $this->quizCategory = $quizCategory->id;
        $this->dispatch('setTitleQuizCategory', $quizCategory->name);
    }

    public function setSearchQuizCategorySearch($data)
    {
        $this->quizCategorySearch = $data;
    }

    public function setValueQuizCategory($data)
    {
        $this->quizCategory = $data;
        $this->resetPage();
    }

    public function resetValueQuizCategory()
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
    }

    public function setValueQuizPhase($data)
    {
        $this->quizPhase = $data;
        $this->resetPage();
    }

    public function resetValueQuizPhase()
    {
        $this->resetPage();
        $this->reset('quizPhase', 'quizPhaseSearch');
    }
}

<?php

namespace App\Livewire\Dashboard\QuizCategory;

use Livewire\Component;
use App\Models\QuizCategory;
use Livewire\Attributes\Url;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshQuizCategoryData' => '$refresh'];

    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        $quizCategories = QuizCategory::withCount('quizzes')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('pages.dashboard.quiz-category.index', compact('quizCategories'))
            ->title(__('Quiz Category'));
    }
}

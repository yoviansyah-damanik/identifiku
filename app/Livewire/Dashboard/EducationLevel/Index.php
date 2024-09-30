<?php

namespace App\Livewire\Dashboard\EducationLevel;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\EducationLevel;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshEducationLevelData' => '$refresh'];

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
        $educationLevels = EducationLevel::with(['grades' => fn($q) => $q->withCount('students')])->where('name', 'like', '%' . $this->search . '%')
            ->withCount('schools', 'grades')
            ->paginate($this->perPage);

        return view('pages.dashboard.education-level.index', compact('educationLevels'))
            ->title(__('Education Level'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }
}

<?php

namespace App\Livewire\Dashboard\GradeLevel;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\EducationLevel;
use App\Models\GradeLevel;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    public array $educationLevels;
    public string $educationLevelSearch = '';
    public string $educationLevel = '';

    protected $listeners = ['refreshGradeLevelData' => '$refresh'];

    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        $this->setEducationLevels();
    }

    public function render()
    {
        $gradeLevels = GradeLevel::with(['educationLevel' => fn($q) => $q->withCount('schools')])
            ->withCount('students')
            ->when($this->educationLevel, fn($q) => $q->where('education_level_id', $this->educationLevel))
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('education_level_id', 'asc')
            ->paginate($this->perPage);

        return view('pages.dashboard.grade-level.index', compact('gradeLevels'))
            ->title(__('Grade Level'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }

    public function setEducationLevels()
    {
        $this->educationLevels = EducationLevel::where('name', 'like', '%' . $this->educationLevelSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($educationLevel) => [
                'title' => $educationLevel->name,
                'value' => $educationLevel->id,
                'description' => $educationLevel->fullAddress,
            ])
            ->toArray();
    }

    public function setSearchEducationLevelSearch($data)
    {
        $this->educationLevelSearch = $data;
        $this->setEducationLevels();
    }

    public function setValueEducationLevelSearch($data)
    {
        $this->educationLevel = $data;
        $this->resetPage();
    }

    public function resetValueEducationLevelSearch()
    {
        $this->resetPage();
        $this->reset('educationLevel', 'educationLevelSearch');
    }
}

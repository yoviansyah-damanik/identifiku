<?php

namespace App\Livewire\Dashboard\Teacher;

use App\Models\School;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshTeacherData' => '$refresh'];

    public int $perPage;

    #[Url]
    public string $search = '';

    public string $schoolSearch = '';

    #[Url]
    public string $school = '';

    public array $perPageList;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        $teachers = Teacher::with(
            'school',
        )
            ->when($this->school, fn($q) => $q->where('school_id', $this->school))
            ->whereAny(['nuptk', 'name'], 'like', "%$this->search%")
            ->paginate($this->perPage);

        $schools = School::where('name', 'like', '%' . $this->schoolSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($school) => [
                'title' => $school->name,
                'value' => $school->id,
                'description' => $school->fullAddress,
            ])
            ->toArray();

        return view('pages.dashboard.teacher.index', compact('teachers', 'schools'))
            ->title(__('Teachers'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }

    public function setSearchSchool(School $school)
    {
        $this->school = $school->id;
        $this->dispatch('setTitleSchool', $school->name);
    }

    public function setSearchSchoolSearch($data)
    {
        $this->schoolSearch = $data;
    }

    public function setValueSchool($data)
    {
        $this->school = $data;
        $this->resetPage();
    }

    public function resetValueSchool()
    {
        $this->resetPage();
        $this->reset('school', 'schoolSearch');
    }
}

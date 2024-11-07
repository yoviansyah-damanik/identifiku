<?php

namespace App\Livewire\Dashboard\TeacherRequest;

use App\Models\School;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\TeacherRequest;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshTeacherRequestData' => '$refresh'];

    public int $perPage;

    #[Url]
    public string $search = '';

    public array $schools;
    public string $schoolSearch = '';
    public string $school = '';

    public array $perPageList;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        $this->setSchools();
    }

    public function render()
    {
        $teachers = TeacherRequest::with(
            'school'
        )
            ->when($this->school, fn($q) => $q->where('school_id', $this->school))
            // ->when(auth()->user()->roleName == 'School', fn($q) => $q->where('school_id', auth()->user()->roleName))
            ->whereAny(['nuptk', 'name'], 'like', "%$this->search%")
            ->paginate($this->perPage);

        return view('pages.dashboard.teacher-request.index', compact('teachers'))
            ->title(__('Teacher Request'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }

    public function setSchools()
    {
        $this->schools = School::where('name', 'like', '%' . $this->schoolSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($school) => [
                'title' => $school->name,
                'value' => $school->id,
                'description' => $school->fullAddress,
            ])
            ->toArray();
    }

    public function setSearchSchool(School $school)
    {
        $this->school = $school->id;
        $this->dispatch('setTitleSchool', $school->name);
    }

    public function setSearchSearchSchool($data)
    {
        $this->schoolSearch = $data;
        $this->setSchools();
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

<?php

namespace App\Livewire\Dashboard\Student;

use App\Models\School;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshStudentData' => '$refresh', 'refreshUserActivation' => '$refresh'];

    public int $perPage;

    #[Url]
    public string $search = '';

    public string $schoolSearch = '';

    public array $schools;
    #[Url]
    public string $school = '';

    public array $perPageList;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        if (auth()->user()->isAdmin)
            $this->setSchools();
    }

    public function render()
    {
        $students = Student::with(
            'school',
            'grade',
            'user',
        )
            ->when(
                auth()->user()->roleName == 'Superadmin',
                fn($q) => $q->when($this->school, fn($q) => $q->where('school_id', $this->school)),
                fn($q) => $q->where('school_id', auth()->user()->getSchoolData->id)
            )
            ->whereAny(['nisn', 'nis', 'name'], 'like', "%$this->search%")
            ->paginate($this->perPage);

        return view('pages.dashboard.student.index', compact('students'))
            ->title(__('Students'));
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

    public function setSearchSchoolSearch($data)
    {
        $this->schoolSearch = $data;
        $this->setSchools();
    }

    public function setValueSchoolSearch($data)
    {
        $this->school = $data;
        $this->resetPage();
    }

    public function resetValueSchoolSearch()
    {
        $this->resetPage();
        $this->reset('school', 'schoolSearch');
    }
}

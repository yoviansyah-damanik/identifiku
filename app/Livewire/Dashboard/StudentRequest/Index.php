<?php

namespace App\Livewire\Dashboard\StudentRequest;

use App\Models\School;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\StudentRequest;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshStudentRequestData' => '$refresh'];

    public int $perPage;

    #[Url]
    public string $search = '';

    public string $schoolSearch = '';
    public string $school = '';

    public array $perPageList;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        $students = StudentRequest::with(
            'school',
            'grade'
        )
            ->when($this->school, fn($q) => $q->where('school_id', $this->school))
            // ->when(auth()->user()->roleName == 'School', fn($q) => $q->where('school_id', auth()->user()->roleName))
            ->whereAny(['nisn', 'local_nis', 'name'], 'like', "%$this->search%")
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

        return view('pages.dashboard.student-request.index', compact('students', 'schools'))
            ->title(__('Student Request'));
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

    public function setSearchSearchSchool($data)
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

<?php

namespace App\Livewire\Dashboard\Class;

use App\Models\School;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Helpers\GeneralHelper;
use App\Models\ClassRequest;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
class Request extends Component
{
    use WithPagination;
    protected $listeners = ['refreshRequestData' => '$refresh'];
    public int $perPage;

    #[Url]
    public string $search = '';

    public string $schoolSearch = '';
    public string $school = '';

    public array $schools;
    public array $perPageList;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        $this->setSchools();
    }

    public function render()
    {
        $requests = ClassRequest::with([
            'student',
            'class',
            'class.teacher',
            'class.teacher.school'
        ])
            ->when(
                !auth()->user()->isAdmin,
                fn($q) => $q->when(
                    auth()->user()->roleName == 'Teacher',
                    fn($r) => $r->whereHas('class', fn($s) => $s->where('teacher_id', auth()->user()->teacher->id))
                        ->whereHas(
                            'class.teacher',
                            fn($s) => $s->where('school_id', auth()->user()->teacher->school->id)
                        ),
                    fn($r) => $r->whereHas(
                        'class.teacher',
                        fn($s) => $s->where('school_id', auth()->user()->school->id)
                    )
                ),
                fn($q) => $q->whereHas(
                    'class.teacher',
                    fn($r) => $r->when($this->school, fn($r) => $r->where('school_id', $this->school))
                )
            )
            ->where(
                fn($q) =>
                $q->where(fn($r) => $r->whereHas('class', fn($s) => $s->where('name', 'like', "%$this->search%")))
                    ->orWhere(fn($r) => $r->whereHas(
                        'student',
                        fn($s) => $s->whereAny(['nisn', 'nis', 'name'], 'like', "%$this->search%")
                    ))
            )

            ->paginate($this->perPage);

        return view('pages.dashboard.class.request', compact('requests'))
            ->title(__('Class Request'));
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

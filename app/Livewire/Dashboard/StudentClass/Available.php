<?php

namespace App\Livewire\Dashboard\StudentClass;

use App\Models\School;
use Livewire\Component;
use App\Models\StudentClass;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.dashboard')]
class Available extends Component
{
    use LivewireAlert, WithPagination;
    protected $listeners = ['refreshAvailableData' => '$refresh'];

    public int $perPage;
    public array $perPageList;

    #[Url]
    public string $search = '';

    public array $schools;
    public string $school = '';
    public string $schoolSearch = '';

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
        if (auth()->user()->isAdmin)
            $this->setSchools();
    }

    public function render()
    {
        $classes = StudentClass::with('teacher', 'teacher.school')
            ->withCount(
                'students',
            )
            ->when(
                !auth()->user()->isAdmin,
                fn($q) => $q->whereHas(
                    'teacher',
                    fn($r) => $r->where('school_id', auth()->user()->schoolData->id)
                ),
                fn($q) => $q->whereHas(
                    'teacher',
                    fn($r) => $r->when($this->school, fn($r) => $r->where('school_id', $this->school))
                )
            )
            ->where('name', 'like', "%$this->search%")
            ->paginate($this->perPage);

        return view('pages.dashboard.student-class.available', compact('classes'))
            ->title(__('Available Classes'));
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

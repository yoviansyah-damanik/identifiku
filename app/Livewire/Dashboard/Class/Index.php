<?php

namespace App\Livewire\Dashboard\Class;

use App\Models\School;
use Livewire\Component;
use App\Models\StudentClass;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination, LivewireAlert;
    protected $listeners = ['refreshClassData' => '$refresh'];
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
        $classes = StudentClass::with('teacher')
            ->withCount(
                'students',
                'quizzes'
            )
            ->when(
                auth()->user()->isAdmin,
                fn($q) => $q->when(
                    $this->school,
                    fn($r) => $r->whereHas('teacher', fn($teacher) => $teacher->where('school_id', $this->school))
                ),
                fn($q) => $q->when(
                    auth()->user()->roleName == 'Teacher',
                    fn($r) => $r->where('teacher_id', auth()->user()->teacher->id)
                        ->whereHas(
                            'teacher',
                            fn($s) => $s->where('school_id', auth()->user()->getSchoolData->id)
                        ),
                    fn($r) => $r->whereIn('teacher_id', auth()->user()->school->teachers->pluck('id')->toArray())
                ),
            )
            ->whereAny(['name'], 'like', "%$this->search%")
            ->paginate($this->perPage);

        return view('pages.dashboard.class.index', compact('classes'))
            ->title(__('Class'));
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

    public function setActivationStatus(StudentClass $class)
    {
        try {
            $class->is_active = !$class->is_active;
            $class->save();
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('School')]));
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }
}

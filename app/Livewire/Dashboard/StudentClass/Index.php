<?php

namespace App\Livewire\Dashboard\StudentClass;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Helpers\GeneralHelper;
use App\Models\StudentHasClass;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;
    protected $listeners = ['refreshClassData' => '$refresh'];

    #[Url]
    public string $search = '';

    public int $perPage;
    public array $perPageList;
    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        $classes = StudentHasClass::with(
            [
                'class' => fn($q) => $q->withCount('students'),
                'student'
            ]
        )
            ->where('student_id', auth()->user()->student->id)
            ->whereHas('class', fn($q) => $q->whereAny(['name'], 'like', "%$this->search%"))
            ->paginate($this->perPage);

        return view('pages.dashboard.student-class.index', compact('classes'))
            ->title(__('My Class'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }
}

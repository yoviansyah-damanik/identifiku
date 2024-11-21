<?php

namespace App\Livewire\Dashboard\StudentClass;

use Livewire\Component;
use App\Models\StudentClass;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;

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
        $classes = StudentClass::whereHas(
            'students',
            fn($q) => $q->where('students.id', auth()->user()->student->id)
        )
            ->whereAny(['name'], 'like', "%$this->search%")
            ->paginate($this->perPage);

        return view('pages.dashboard.student-class.index', compact('classes'))
            ->title(__('My Class'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }
}

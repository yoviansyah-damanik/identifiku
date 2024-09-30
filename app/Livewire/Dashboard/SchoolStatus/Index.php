<?php

namespace App\Livewire\Dashboard\SchoolStatus;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\SchoolStatus;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshSchoolStatusData' => '$refresh'];

    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];
    }

    public function render()
    {
        $schoolStatuses = SchoolStatus::with(['schools' => fn($q) => $q->withCount('students')])
            ->withCount('schools')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('pages.dashboard.school-status.index', compact('schoolStatuses'))
            ->title(__('School Status'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }
}

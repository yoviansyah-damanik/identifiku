<?php

namespace App\Livewire\Dashboard\SchoolRequest;

use Livewire\Component;
use App\Models\SchoolStatus;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\SchoolRequest;
use App\Helpers\GeneralHelper;
use App\Models\EducationLevel;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshSchoolRequestData' => '$refresh'];
    public array $perPageList, $educationLevels, $schoolStatuses;
    public int $perPage;

    public string $educationLevel = 'all',
        $schoolStatus = 'all';

    #[Url]
    public string $search = '';

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];

        $educationLevels = EducationLevel::get();
        $schoolStatuses = SchoolStatus::get();

        $this->educationLevels = [
            [
                'title' => __('All'),
                'value' => 'all'
            ],
            ...$educationLevels->map(fn($q) => ['title' => $q->name, 'value' => $q->id])->toArray()
        ];

        $this->schoolStatuses = [
            [
                'title' => __('All'),
                'value' => 'all'
            ],
            ...$schoolStatuses->map(fn($q) => ['title' => $q->name, 'value' => $q->id])->toArray()
        ];
    }

    public function render()
    {
        $schools = SchoolRequest::with(
            'province',
            'regency',
            'district',
            'village',
            'educationLevel',
            'status',
        )
            ->when($this->educationLevel != 'all' && collect($this->educationLevels)->some(fn($educationLevel) => $educationLevel['value'] == $this->educationLevel), fn($q) => $q->where('education_level_id', $this->educationLevel))
            ->when($this->schoolStatus != 'all' && collect($this->schoolStatuses)->some(fn($schoolStatus) => $schoolStatus['value'] == $this->schoolStatus), fn($q) => $q->where('school_status_id', $this->schoolStatus))
            ->whereAny(['npsn', 'nss', 'nis', 'name'], 'like', "%$this->search%")
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        return view('pages.dashboard.school-request.index', compact('schools'))
            ->title(__('School Request'));
    }
}

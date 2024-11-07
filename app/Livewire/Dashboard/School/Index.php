<?php

namespace App\Livewire\Dashboard\School;

use App\Models\School;
use Livewire\Component;
use App\Models\SchoolStatus;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\EducationLevel;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $listeners = ['refreshSchoolData' => '$refresh'];
    public int $perPage;

    #[Url]
    public string $search = '';

    public array $perPageList, $educationLevels,
        $schoolStatuses, $activationStatuses, $openStatuses;

    public string $educationLevel = 'all',
        $schoolStatus = 'all',
        $activationStatus = 'all',
        $openStatus = 'all';

    public function mount()
    {
        $educationLevels = EducationLevel::get();
        $schoolStatuses = SchoolStatus::get();

        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];

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

        $this->activationStatuses = [
            ['title' => __('All'), 'value' => 'all'],
            ['title' => __('Active'), 'value' => '1'],
            ['title' => __('Inactive'), 'value' => '0'],
        ];

        $this->activationStatuses = [
            ['title' => __('All'), 'value' => 'all'],
            ['title' => __('Active'), 'value' => '1'],
            ['title' => __('Inactive'), 'value' => '0'],
        ];

        $this->openStatuses = [
            ['title' => __('All'), 'value' => 'all'],
            ['title' => __('Open'), 'value' => '1'],
            ['title' => __('Closed'), 'value' => '0'],
        ];
    }

    public function render()
    {
        $schools = School::with(
            'educationLevel',
            'status',
            'user',
        )
            ->withCount('students')
            ->when($this->educationLevel != 'all' && collect($this->educationLevels)->some(fn($educationLevel) => $educationLevel['value'] == $this->educationLevel), fn($q) => $q->where('education_level_id', $this->educationLevel))
            ->when($this->schoolStatus != 'all' && collect($this->schoolStatuses)->some(fn($schoolStatus) => $schoolStatus['value'] == $this->schoolStatus), fn($q) => $q->where('school_status_id', $this->schoolStatus))
            ->when($this->activationStatus != 'all' && collect($this->activationStatuses)->some(fn($activationStatus) => $activationStatus['value'] == $this->activationStatus), fn($q) => $q->where('is_active', $this->activationStatus))
            ->when($this->openStatus != 'all' && collect($this->openStatuses)->some(fn($openStatus) => $openStatus['value'] == $this->openStatus), fn($q) => $q->where('is_open', $this->openStatus))
            ->whereAny(['npsn', 'nss', 'nis', 'name'], 'like', "%$this->search%")
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        return view('pages.dashboard.school.index', compact('schools'))
            ->title(__('School'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }

    public function setActivationStatus(School $school)
    {
        try {
            $school->is_active = !$school->is_active;
            $school->save();
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('School')]));
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function setOpenStatus(School $school)
    {
        try {
            $school->is_open = !$school->is_open;
            $school->save();
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('School')]));
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function regenerateToken(School $school)
    {
        try {
            $school->token = GeneralHelper::getRandomToken();
            $school->save();
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Token')]));
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }
}

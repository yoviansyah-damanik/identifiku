<?php

namespace App\Livewire\Dashboard\Region;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\Region;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refreshRegionData' => '$refresh'];

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
        $regions = Region::with([
            'schoolProvince',
            'schoolRegency',
            'schoolDistrict',
            'schoolVillage',
        ])
            ->whereAny(['code', 'name'], 'like', '%' . $this->search . '%')
            ->orderBy('code', 'asc')
            ->paginate($this->perPage);

        return view('pages.dashboard.region.index', compact('regions'))
            ->title(__('Region'));
    }

    public function updated($attribute)
    {
        $this->resetPage();
    }
}

<?php

namespace App\Livewire\Dashboard\Region;

use App\Models\Region;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;

    public Region $region;
    public string $name;
    public string $code;

    #[On('setEditRegion')]
    public function setEditRegion(Region $region)
    {
        $this->region = $region;
        $this->name = $region->name;
        $this->code = $region->code;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('regions', 'code')->ignore($this->region->code, 'code')
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Region')]),
            'code' => __('Description')
        ];
    }

    public function render()
    {
        return view('pages.dashboard.region.edit');
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->region->update([
                'name' => $this->name,
                'code' => $this->code,
            ]);

            $this->dispatch('toggle-edit-region-modal');
            $this->dispatch('refreshRegionData');
            $this->reset();

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Region')]));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

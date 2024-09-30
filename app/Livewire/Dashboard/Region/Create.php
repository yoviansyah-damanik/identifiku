<?php

namespace App\Livewire\Dashboard\Region;

use App\Models\Region;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;
    public string $name;
    public string $code;

    public function render()
    {
        return view('pages.dashboard.region.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'code' => 'required|string|max:20|unique:regions,code'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Region')]),
            'code' => __('Description')
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function store()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            Region::create([
                'name' => $this->name,
                'code' => $this->code,
            ]);

            $this->dispatch('toggle-create-region-modal');
            $this->dispatch('refreshRegionData');
            $this->reset();

            $this->alert('success', __(':attribute created successfully.', ['attribute' => __('Region')]));
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

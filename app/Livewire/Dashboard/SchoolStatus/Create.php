<?php

namespace App\Livewire\Dashboard\SchoolStatus;

use App\Models\SchoolStatus;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class Create extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;
    public string $name;
    public string $description;

    public function render()
    {
        return view('pages.dashboard.school-status.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:255'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('School Status')]),
            'description' => __('Description')
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
            SchoolStatus::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('toggle-create-school-status-modal');
            $this->dispatch('refreshSchoolStatusData');

            $this->alert('success', __(':attribute created successfully.', ['attribute' => __('School Status')]));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    #[On('toggle-create-school-status-modal')]
    public function refresh()
    {
        $this->reset();
        $this->isLoading = false;
    }
}

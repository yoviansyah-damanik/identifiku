<?php

namespace App\Livewire\Dashboard\Class;

use App\Helpers\GeneralHelper;
use App\Models\StudentClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public string $name;
    public string $description;
    public ?string $expiredAt = null;

    public bool $isLoading = false;
    public bool $isLimit = false;

    public function mount()
    {
        if (auth()->user()->isClassLimit) {
            $this->isLoading = true;
            $this->isLimit = true;
        }

        if (!GeneralHelper::isProduction())
            $this->dev();
    }

    public function dev()
    {
        $this->name = fake()->name;
        $this->description = fake()->sentence();
    }

    public function render()
    {
        return view('pages.dashboard.class.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'expiredAt' => 'nullable|date|after:' . now()->format('Y-m-d'),
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Class')]),
            'description' => __('Description'),
            'expiredAt' => __('Expired Date'),
            'updatedAt' => __('Updated At')
        ];
    }

    public function store()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            StudentClass::create([
                'name' => $this->name,
                'description' => $this->description,
                'teacher_id' => auth()->user()->teacher->id,
                'expired_at' => $this->expiredAt
            ]);

            $this->dispatch('toggle-create-class-modal');
            $this->dispatch('refreshClassData');

            $this->alert('success', __(':attribute created successfully.', ['attribute' => __('Class')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    #[On('toggle-create-class-modal')]
    public function refresh()
    {
        $this->reset();
        $this->isLoading = false;

        if (!GeneralHelper::isProduction())
            $this->dev();
    }
}

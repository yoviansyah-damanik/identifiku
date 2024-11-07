<?php

namespace App\Livewire\Dashboard\Class;

use App\Models\StudentClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public StudentClass $class;
    public string $name;
    public string $description;
    public ?string $expiredAt = null;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.class.edit');
    }

    #[On('setEditClass')]
    public function setClass(StudentClass $class)
    {
        $this->refresh();

        $this->class = $class;
        $this->name = $class->name;
        $this->description = $class->description;
        $this->expiredAt =  $class?->expired_at ? $class->expired_at->format('Y-m-d') : null;

        $this->isLoading = false;
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
            'expiredAt' => __('Expired Date')
        ];
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->class->update([
                'name' => $this->name,
                'description' => $this->description,
                'expired_at' => $this->expiredAt ?: null
            ]);

            $this->dispatch('toggle-edit-class-modal');
            $this->dispatch('refreshClassData');

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Class')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    #[On('clearModal')]
    public function refresh()
    {
        $this->reset();
        $this->isLoading = true;
    }
}

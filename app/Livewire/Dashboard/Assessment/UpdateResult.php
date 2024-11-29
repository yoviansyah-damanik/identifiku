<?php

namespace App\Livewire\Dashboard\Assessment;

use App\Models\Result;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UpdateResult extends Component
{
    use LivewireAlert;
    public Result $result;

    public ?string $advice;
    public ?string $conclusion;

    public bool $isLoading = true;

    public function mount(Result $result)
    {
        $this->isLoading = true;
        $this->result = $result;
        $this->advice = $result->advice;
        $this->conclusion = $result->conclusion;
        $this->dispatch('set-conclusion-textarea-value', $result->conclusion);
        $this->dispatch('set-advice-textarea-value', $result->advice);
        $this->isLoading = false;
    }

    public function render()
    {
        return view('pages.dashboard.assessment.update-result');
    }

    public function rules()
    {
        return [
            'advice' => 'required|string',
            'conclusion' => 'required|string',
        ];
    }

    public function validationAttributes()
    {
        return [
            'advice' => __('Advice'),
            'conclusion' => __('Conclusion'),
        ];
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->result->update([
                'advice' => $this->advice,
                'conclusion' => $this->conclusion,
            ]);
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Message')]));
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

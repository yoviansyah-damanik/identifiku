<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\AssessmentIndicatorRule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteIndicatorRule extends Component
{
    use LivewireAlert;

    #[On('setDeleteIndicatorRule')]
    public function setDeleteIndicatorRule(AssessmentIndicatorRule $indicator)
    {
        try {
            $indicator->delete();
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Indicator Rule')]));
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }
}

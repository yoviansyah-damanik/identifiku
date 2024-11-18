<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AssessmentRule;
use Illuminate\Validation\Rule;
use App\Models\AssessmentRuleDetail;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditIndicator extends Component
{
    use LivewireAlert;
    public AssessmentRuleDetail $detail;

    public string $indicator;
    public ?int $value_min;
    public ?int $value_max;
    public int | string | null $score;
    public string $default;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.edit-indicator');
    }

    #[On('setEditIndicator')]
    public function setEditIndicator(AssessmentRuleDetail $detail)
    {
        $this->refresh();
        $this->detail = $detail;
        $this->indicator = $detail->indicator;
        $this->value_min = $detail->value_min;
        $this->value_max = $detail->value_max;
        $this->score = $detail->score;
        $this->dispatch('set-indicator-textarea-value', $detail->indicator);
        $this->isLoading = false;
    }

    public function refresh()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function rules()
    {
        return [
            'indicator' => 'required|string',
            'value_min' => [
                'nullable',
                'numeric',
                Rule::requiredIf($this->detail->main->type == 'summative')
            ],
            'value_max' => [
                'nullable',
                'numeric',
                'gt:value_min',
                Rule::requiredIf($this->detail->main->type == 'summative')
            ],
            'score' => [
                'nullable',
                $this->detail->main->type == 'calculation-2' ? 'numeric' : 'string',
                $this->detail->main->type == 'calculation-2' ? 'digits_between:1,3' : '',
                $this->detail->main->type == 'summative' ? 'max:3' : '',
                Rule::requiredIf(in_array($this->detail->main->type, ['calculation-2', 'summative']))
            ],
            'default' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'indicator' => __('Indicator'),
            'value_min' => __('Min'),
            'value_max' => __('Max'),
            'score' => __('Score')
        ];
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->detail->update([
                'indicator' => $this->indicator,
                'value_min' => $this->value_min ?? null,
                'value_max' => $this->value_max ?? null,
                'default' => $this->default ?? null,
                'score' => $this->score ?? null,
            ]);

            $this->dispatch('toggle-edit-indicator-modal');
            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Indicator')]));
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

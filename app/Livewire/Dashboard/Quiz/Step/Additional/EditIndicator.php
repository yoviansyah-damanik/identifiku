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

    public array $operators;
    public string $operator;

    public bool $isLoading = true;

    public function mount()
    {
        $this->operators = ["<", "<=", "=", ">=", ">"];
        $this->operator = "=";
    }

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
            'operator' => [
                'nullable',
                'string',
                Rule::requiredIf($this->detail->main->type == 'summative'),
                Rule::in($this->operators)
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'indicator' => __('Indicator'),
            'value_min' => __('Min'),
            'value_max' => __('Max'),
            'operator' => __('Operator')
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

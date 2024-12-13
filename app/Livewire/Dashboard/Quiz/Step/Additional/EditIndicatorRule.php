<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\AssessmentIndicatorRule;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use App\Models\AssessmentRuleDetail;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditIndicatorRule extends Component
{
    use LivewireAlert;
    public AssessmentIndicatorRule $indicatorRule;

    public ?string $title;
    public string $indicator;
    public string $recommendation;
    public ?int $value_min;
    public ?int $value_max;
    public int | string | null $score;
    public ?string $default;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.edit-indicator-rule');
    }

    #[On('setEditIndicator')]
    public function setEditIndicator(AssessmentIndicatorRule $indicatorRule)
    {
        $this->refresh();
        $this->indicatorRule = $indicatorRule;
        $this->title = $indicatorRule->title;
        $this->indicator = $indicatorRule->indicator;
        $this->recommendation = $indicatorRule->recommendation;
        $this->value_min = $indicatorRule->value_min;
        $this->value_max = $indicatorRule->value_max;
        $this->dispatch('set-indicatorRule-textarea-value', $indicatorRule->indicator);
        $this->dispatch('set-recommendation-textarea-value', $indicatorRule->recommendation);
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
            'title' => [
                'nullable',
                'string',
                Rule::requiredIf(in_array($this->indicatorRule->main->type, ['summation', 'summative']))
            ],
            'indicator' => 'required|string',
            'recommendation' => 'required|string',
            'value_min' => [
                'nullable',
                'numeric',
                Rule::requiredIf($this->indicatorRule->main->type == 'summative')
            ],
            'value_max' => [
                'nullable',
                'numeric',
                'gt:value_min',
                Rule::requiredIf($this->indicatorRule->main->type == 'summative')
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => __('Title'),
            'indicator' => __('Indicator'),
            'recommendation' => __('Recommendation'),
            'value_min' => __('Min'),
            'value_max' => __('Max'),
        ];
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->indicatorRule->update([
                'title' => $this->title,
                'indicator' => $this->indicator,
                'recommendation' => $this->recommendation,
                'value_min' => $this->value_min ?? null,
                'value_max' => $this->value_max ?? null,
            ]);

            $this->dispatch('toggle-edit-indicator-modal');
            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Indicator Rule')]));
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

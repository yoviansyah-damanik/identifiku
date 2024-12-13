<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AssessmentRule;
use Illuminate\Validation\Rule;
use App\Models\AssessmentIndicatorRule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddIndicatorRule extends Component
{
    use LivewireAlert;
    public AssessmentRule $rule;

    public string $title;
    public string $indicator;
    public string $recommendation;
    public int $value_min;
    public int $value_max;
    public string $answer;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.add-indicator-rule');
    }

    #[On('setAddIndicator')]
    public function setAddIndicator(AssessmentRule $rule, string $answer)
    {
        $this->refresh();
        $this->rule = $rule;
        $this->answer = $answer;
        $this->isLoading = false;
    }

    public function refresh()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatch('clear-textarea');
        $this->isLoading = false;
    }

    public function rules()
    {
        return [
            'title' => [
                'nullable',
                'string',
                Rule::requiredIf(in_array($this->rule->type, ['summation', 'summative']))
            ],
            'indicator' => 'required|string',
            'recommendation' => 'required|string',
            'value_min' => [
                'nullable',
                'numeric',
                Rule::requiredIf($this->rule->type == 'summative')
            ],
            'value_max' => [
                'nullable',
                'numeric',
                'gt:value_min',
                Rule::requiredIf($this->rule->type == 'summative')
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

    public function add()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            AssessmentIndicatorRule::create([
                'assessment_rule_id' => $this->rule->id,
                'title' => $this->title,
                'indicator' => $this->indicator,
                'recommendation' => $this->recommendation,
                'answer' => $this->answer,
                'value_min' => $this->value_min ?? null,
                'value_max' => $this->value_max ?? null,
            ]);

            $this->dispatch('toggle-add-indicator-modal');
            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute added successfully.', ['attribute' => __('Indicator Rule')]));
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

<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\AssessmentRule;
use App\Models\AssessmentRuleDetail;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class AddIndicator extends Component
{
    use LivewireAlert;
    public AssessmentRule $rule;

    public string $indicator;
    public int $value_min;
    public int $value_max;
    public int | string $score;
    public string $answer;
    public string $default;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.add-indicator');
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
            'indicator' => 'required|string',
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
            'score' => [
                'nullable',
                $this->rule->type == 'calculation-2' ? 'numeric' : 'string',
                $this->rule->type == 'calculation-2' ? 'digits_between:1,3' : '',
                $this->rule->type == 'summative' ? 'max:3' : '',
                Rule::requiredIf(in_array($this->rule->type, ['calculation-2', 'summative']))
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
            'default' => __('Default'),
            'score' => __('Score')
        ];
    }

    public function add()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            AssessmentRuleDetail::create([
                'assessment_rule_id' => $this->rule->id,
                'indicator' => $this->indicator,
                'answer' => $this->answer,
                'value_min' => $this->value_min ?? null,
                'value_max' => $this->value_max ?? null,
                'default' => $this->default ?? null,
                'score' => $this->score ?? null,
            ]);

            $this->dispatch('toggle-add-indicator-modal');
            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute added successfully.', ['attribute' => __('Indicator')]));
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

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
    public string $answer;

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
            'operator' => [
                'nullable',
                'string',
                Rule::requiredIf($this->rule->type == 'summative'),
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

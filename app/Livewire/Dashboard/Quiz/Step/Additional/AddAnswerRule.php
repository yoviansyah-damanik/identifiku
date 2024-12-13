<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AssessmentRule;
use Illuminate\Validation\Rule;
use App\Models\AssessmentAnswerRule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddAnswerRule extends Component
{
    use LivewireAlert;
    public AssessmentRule $rule;

    public string $default;
    public int $score;
    public string $answer;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.add-answer-rule');
    }

    #[On('setAddQuestion')]
    public function setAddQuestion(AssessmentRule $rule, string $answer)
    {
        $this->refresh();
        $this->rule = $rule;
        $this->answer = $answer;
        $this->isLoading = false;
    }

    public function rules()
    {
        return [
            'default' => [
                'nullable',
                'string',
            ],
            'score' => [
                'nullable',
                in_array($this->rule->type, ['calculation-2']) ? 'numeric|min:1' : '',
                Rule::requiredIf(in_array($this->rule->type, ['calculation-2']))
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'default' => __('Default'),
            'score' => __('Score')
        ];
    }

    public function refresh()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatch('clear-textarea');
        $this->isLoading = false;
    }

    public function add()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            AssessmentAnswerRule::create([
                'assessment_rule_id' => $this->rule->id,
                'answer' => $this->answer,
                'default' => $this->default ?? null,
                'score' => $this->score ?? null,
            ]);

            $this->dispatch('toggle-add-answer-modal');
            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute added successfully.', ['attribute' => __('Answer Rule')]));
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

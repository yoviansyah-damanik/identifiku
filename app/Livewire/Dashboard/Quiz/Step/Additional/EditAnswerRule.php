<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AssessmentRule;
use Illuminate\Validation\Rule;
use App\Models\AssessmentAnswerRule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditAnswerRule extends Component
{
    use LivewireAlert;
    public AssessmentAnswerRule $answerRule;

    public ?string $default;
    public ?int $score;
    public string $answer;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.edit-answer-rule');
    }

    #[On('setEditQuestion')]
    public function setEditQuestion(AssessmentAnswerRule $answerRule)
    {
        $this->refresh();
        $this->answerRule = $answerRule;
        $this->answer = $answerRule->answer;
        $this->default = $answerRule->default;
        $this->score = $answerRule->score;
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
            'default' => [
                'nullable',
                'string',
            ],
            'score' => [
                'nullable',
                in_array($this->answerRule->main->type, ['calculation-2', 'group-calculation']) ? ['numeric', 'min:1'] : '',
                Rule::requiredIf(in_array($this->answerRule->main->type, ['calculation-2', 'group-calculation']))
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

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->answerRule->update([
                'answer' => $this->answer,
                'default' => $this->default ?? null,
                'score' => $this->score ?? null,
            ]);

            $this->dispatch('toggle-edit-answer-modal');
            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Assessment Answer Rule')]));
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

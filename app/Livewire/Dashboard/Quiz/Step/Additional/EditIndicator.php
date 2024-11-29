<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use App\Models\AssessmentRuleDetail;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditIndicator extends Component
{
    use LivewireAlert;
    public AssessmentRuleDetail $detail;

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
        return view('pages.dashboard.quiz.step.additional.edit-indicator');
    }

    #[On('setEditIndicator')]
    public function setEditIndicator(AssessmentRuleDetail $detail)
    {
        $this->refresh();
        $this->detail = $detail;
        $this->title = $detail->title;
        $this->indicator = $detail->indicator;
        $this->recommendation = $detail->recommendation;
        $this->value_min = $detail->value_min;
        $this->value_max = $detail->value_max;
        $this->score = $detail->score;
        $this->default = $detail->default;
        $this->dispatch('set-indicator-textarea-value', $detail->indicator);
        $this->dispatch('set-recommendation-textarea-value', $detail->recommendation);
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
                Rule::requiredIf(in_array($this->detail->main->type, ['summation', 'summative']))
            ],
            'indicator' => 'required|string',
            'recommendation' => 'required|string',
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
            'title' => __('Title'),
            'indicator' => __('Indicator'),
            'recommendation' => __('Recommendation'),
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
                'title' => $this->title,
                'indicator' => $this->indicator,
                'recommendation' => $this->recommendation,
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

<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\GeneralHelper;
use App\Models\AssessmentRule;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Isolate;
use Illuminate\Support\Facades\DB;
use App\Models\AssessmentRuleDetail;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Isolate]
class StepTwo extends Component
{
    use LivewireAlert;

    protected $listeners = ['refreshQuizData' => '$refresh'];

    public Quiz $quiz;

    public array $questionTypes;
    public string $questionType;

    public array $assessmentRules;
    public string $assessmentRule;

    public int $max = 2;

    public array $answers;
    public array $indicators;

    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->questionTypes = GeneralHelper::getQuestionType();
        $this->questionType = $this->questionTypes[0]['value'];

        $this->checkRules();

        if ($quiz->assessmentRule) {
            $this->questionType = $quiz->assessmentRule->question_type;
            $this->assessmentRule = $quiz->assessmentRule->type;
            $this->max = $quiz->assessmentRule->max_item;
        }
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-two');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="text-center">
            <x-loading/>
        </div>
        HTML;
    }

    #[On('refreshQuizData')]
    public function refreshQuizData()
    {
        $this->quiz = $this->quiz->refresh()
            ->load(['assessmentRule', 'assessmentRule.details']);
    }

    public function rules()
    {
        return [
            'questionType' => [
                'required',
                Rule::in(collect($this->questionTypes)->pluck('value')->toArray())
            ],
            'assessmentRule' => [
                'required',
                Rule::in(collect($this->assessmentRules)->pluck('value')->toArray())
            ],
            'max' => [
                'numeric',
                'min:1',
                Rule::requiredIf($this->questionType != 'dichotomous' || ($this->questionType == 'dichotomous' && $this->assessmentRule == 'summative'))
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'questionType' => __(':type Type', ['type' => __('Question')]),
            'assessmentRule' => __('Assessment Rule'),
            'max' => __('Max'),
        ];
    }

    public function checkRules()
    {
        $this->isLoading = true;
        $this->assessmentRules = GeneralHelper::getAssessmentRuleType($this->questionType);
        $this->assessmentRule = $this->assessmentRules[0]['value'];
        $this->isLoading = false;
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $exist = $this->quiz->assessmentRule;
            if ($exist) {
                $exist->update(
                    [
                        'question_type' => $this->questionType,
                        'type' => $this->assessmentRule,
                        'max_item' => $this->questionType != 'dichotomous' || ($this->questionType == 'dichotomous' && $this->assessmentRule == 'summative') ? $this->max : 2
                    ]
                );

                $exist->details()->delete();
                $this->quiz->groups()->delete();
            } else {
                $this->quiz->assessmentRule()->create(
                    [
                        'question_type' => $this->questionType,
                        'type' => $this->assessmentRule,
                        'max_item' => $this->questionType != 'dichotomous' || ($this->questionType == 'dichotomous' && $this->assessmentRule == 'summative') ? $this->max : 2
                    ]
                );
            }

            DB::commit();
            $this->dispatch('refreshQuizData');
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Assessment Rule')]));
            $this->isLoading = false;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    public function deleteIndicator(AssessmentRuleDetail $detail)
    {
        try {
            $detail->delete();
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Indicator')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

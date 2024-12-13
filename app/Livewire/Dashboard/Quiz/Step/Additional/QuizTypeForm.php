<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\Quiz;
use Livewire\Component;
use App\Helpers\QuizHelper;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class QuizTypeForm extends Component
{
    use LivewireAlert;
    public Quiz $quiz;

    public array $questionTypes;
    public string $questionType;

    public array $assessmentRules;
    public string $assessmentRule;

    public int $max_answer = 0;
    public int $max_indicator = 0;

    public array $answers;
    public array $indicators;

    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->questionTypes = QuizHelper::getQuestionType($quiz->type);
        $this->questionType = $this->questionTypes[0]['value'];
        $this->checkRules(true);

        if ($quiz->assessmentRule) {
            $this->questionType = $quiz->assessmentRule->question_type;
            $this->assessmentRule = $quiz->assessmentRule->type;
            $this->max_answer = $quiz->type == 'keirseyTemperamentSorter' ? 4 : $quiz->assessmentRule->max_answer;
            $this->max_indicator = $quiz->type == 'keirseyTemperamentSorter' ? 4 : $quiz->assessmentRule->max_indicator;
        } else {
            $this->max_answer = $quiz->type == 'keirseyTemperamentSorter' ? 4 : 0;
            $this->max_indicator = $quiz->type == 'keirseyTemperamentSorter' ? 4 : 0;
        }
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.quiz-type-form');
    }

    public function checkRules(bool $isExist = false)
    {
        $this->isLoading = true;
        $this->assessmentRules = QuizHelper::getAssessmentRuleType($this->quiz->type, $this->questionType);

        if ($isExist === true) {
            $this->max_indicator = 0;
            $this->max_answer = 0;
            $this->assessmentRule = $this->assessmentRules[0]['value'];

            if ($this->questionType == 'dichotomous') {
                $this->max_indicator = 2;
                $this->max_answer = 2;
            }
        }

        $this->isLoading = false;
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
            'max_answer' => [
                'numeric',
                $this->questionType == 'multipleChoice' && !in_array($this->assessmentRule, ['calculation']) ? 'min:1' : '',
                Rule::requiredIf(!in_array($this->assessmentRule, ['calculation'])),
            ],
            'max_indicator' => [
                'numeric',
                $this->questionType == 'multipleChoice' && in_array($this->assessmentRule, ['calculation-2', 'summative']) ? 'min:1' : '',
                Rule::requiredIf(in_array($this->assessmentRule, ['calculation-2', 'summative'])),
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'questionType' => __(':type Type', ['type' => __('Question')]),
            'assessmentRule' => __('Assessment Rule'),
            'max_indicator' => __('Max Indicator'),
            'max_answer' => __('Max Answer Options'),
        ];
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $exist = $this->quiz->assessmentRule;
            if ($exist) {
                if ($exist->max_answer != $this->max_answer) {
                    $exist->answers()->delete();
                    $this->quiz->groups()->delete();

                    foreach (range(0, $this->max_answer - 1) as $x) {
                        $exist->answers()->create([
                            'answer' => GeneralHelper::numberToAlpha($x + 1)
                        ]);
                    }
                }

                if ($exist->max_indicator != $this->max_indicator || $exist->type == 'group-calculation')
                    $exist->indicators()->delete();

                $newRule = $exist->update(
                    [
                        'question_type' => $this->questionType,
                        'type' => $this->assessmentRule,
                        'max_answer' => $this->questionType == 'dichotomous' ? 2 : $this->max_answer,
                        'max_indicator' => $this->assessmentRule == 'group-calculation' ? 0 : (in_array($this->assessmentRule, ['summation', 'calculation']) ? $this->max_answer : $this->max_indicator)
                    ]
                );
                $newRule = $exist;
            } else {
                $newRule = $this->quiz->assessmentRule()->create(
                    [
                        'question_type' => $this->questionType,
                        'type' => $this->assessmentRule,
                        'max_answer' => $this->questionType == 'dichotomous' ? 2 : $this->max_answer,
                        'max_indicator' => $this->assessmentRule == 'group-calculation' ? 0 : (in_array($this->assessmentRule, ['summation', 'calculation']) ? $this->max_answer : $this->max_indicator)
                    ]
                );

                foreach (range(0, $this->max_answer - 1) as $x) {
                    $newRule->answers()->create([
                        'answer' => GeneralHelper::numberToAlpha($x + 1)
                    ]);
                }
            }

            DB::commit();
            $this->dispatch('setRule', $newRule->id);
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
}

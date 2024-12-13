<?php

namespace App\Livewire\Assessment\Step;

use App\Helpers\AssessmentHelper;
use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\On;
use Livewire\Attributes\Isolate;
use App\Jobs\AssessmentResultJob;
use App\Models\AnswerChoice;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Isolate]
class StepTwo extends Component
{
    use LivewireAlert;

    public Assessment $assessment;

    public Collection $questions;
    public Collection $groupActive;
    public Collection $questionActive;
    public Collection $result;

    public ?Collection $calculationAnswers = null;

    public bool $nextButton = true;
    public bool $prevButton = false;

    public function mount(Assessment $assessment)
    {
        $this->questions = new Collection();
        $this->groupActive = new Collection();
        $this->questionActive = new Collection();
        $this->result = new Collection();

        $this->assessment = $assessment
            ->load(
                'details',
                'details.answer',
                'rule',
                'rule.answers',
                'rule.indicators',
                'quiz',
                'quiz.groups',
                'quiz.groups.questions',
                'quiz.groups.questions.answers',
            );

        $this->setResult();
        $this->initQuestions();
        $this->setFirstQuestion();
        $this->setDetailsData();
        $this->setScoreToQuestion();
    }

    public function render()
    {
        return view('pages.assessment.step.step-two');
    }

    public function initQuestions()
    {
        $this->questions = $this->assessment
            ->quiz
            ->groups
            ->map(
                function ($group) {
                    return collect([
                        ...collect($group)->only(['id', 'name', 'description', 'order'])->toArray(),
                        'questions' => $group->questions->map(function ($question) {
                            return collect([
                                ...collect($question)->except(['created_at', 'updated_at', 'question_group_id']),
                                'answers' => $question->answers->map(function ($answer, $question) {
                                    $exist = $this->result->where('question_id', $question)->first();

                                    return collect([
                                        ...collect($answer)->only(['id', 'answer', 'text'])->toArray(),
                                        'is_selected' =>  $exist ? ($exist['answer'] == $answer['answer']) : false
                                    ]);
                                })
                            ]);
                        })
                    ]);
                }
            );
    }

    public function setQuestions()
    {
        $this->questions = $this->questions->map(
            function ($group) {
                return collect([
                    ...collect($group)->except(['questions'])->toArray(),
                    'questions' => collect($group['questions'])->map(function ($question) {
                        return collect([
                            ...collect($question)->except(['answers']),
                            'answers' => collect($question['answers'])->map(function ($answer, $question) {
                                $exist = $this->result->where('question_id', $question)->first();
                                return collect([
                                    ...collect($answer)->only(['id', 'answer', 'text'])->toArray(),
                                    'is_selected' =>  $exist ? ($exist['answer'] == $answer['answer']) : false
                                ]);
                            })
                        ]);
                    })
                ]);
            }
        );
    }

    public function setFirstQuestion()
    {
        $this->groupActive = $this->questions->first();
        $this->questionActive = $this->questions->first()['questions'][0];
    }

    public function setQuestion($group, $question)
    {
        $this->groupActive = $this->questions->where('id', $group)->first();
        $this->questionActive = collect($this->questions->where('id', $group)->first()['questions'])
            ->where('id', $question)->first();

        $this->setScoreToQuestion();
        $this->checkNextButton();
        $this->checkPrevButton();
    }

    public function setScoreToQuestion()
    {
        if ($this->assessment->rule->type == 'calculation') {
            $this->calculationAnswers = $this->setCalculationAnswers();
        } elseif ($this->assessment->rule->type == 'group-calculation') {
            $this->calculationAnswers = $this->setGroupCalculationAnswers();
        } elseif ($this->assessment->rule->type == 'calculation-2') {
            $this->calculationAnswers = $this->setCalculation2Answers();
        }
    }

    protected function setCalculationAnswers()
    {
        $answers = $this->assessment->refresh()->details()->where('question_id', $this->questionActive['id'])->get();
        $result = collect($answers)
            ->map(fn($item, $idx) => [
                'id' => $item->answer_choice_id,
                'score' => $item->score,
                'answer' => $item->answer->text
            ])
            ->sortBy('score');

        foreach ($result as $idx => $item) {
            $this->setAnswer(question: $this->questionActive['id'], answer: $item['id'], score: $idx + 1);
        }
        return $result;
    }

    protected function setGroupCalculationAnswers()
    {
        $result = collect($this->questionActive['answers'])
            ->map(fn($item, $idx) => [
                'id' => $item['id'],
                'score' => $this->assessment->rule->answers()->where('answer', $item['answer'])->first()->score,
                'answer' => $item['answer'],
                'text' => $item['text'],
            ])
            ->sortBy('answer');

        return $result;
    }

    protected function setCalculation2Answers()
    {
        $result = collect($this->questionActive['answers'])
            ->map(fn($item, $idx) => [
                'id' => $item['id'],
                'score' => $this->assessment->quiz->groups
                    ->map(
                        fn($group)
                        => $group->questions()->where('id', $this->questionActive['id'])
                            ->first()->answers->where('id', $item['id'])->first()->score
                    )[0],
                'answer' => $item['answer'],
                'text' => $item['text'],
            ])
            ->sortBy('answer');

        return $result;
    }

    public function setResult()
    {
        if (in_array($this->assessment->rule->type, ['summation', 'summative', 'calculation-2', 'group-calculation'])) {
            $this->result = $this->assessment->details->count() > 0 ? $this->assessment->details
                ->whereNotNull('answer_choice_id')->map(function ($detail) {
                    return collect($detail)->only(['question_id', 'answer_choice_id']);
                }) : new Collection();
        }

        if (in_array($this->assessment->rule->type, ['calculation'])) {
            $this->result = $this->assessment->details->count() > 0 ? $this->assessment->details
                ->whereNotNull('answer_choice_id')->map(function ($detail) {
                    return collect($detail)->only(['question_id', 'answer_choice_id', 'score']);
                }) : new Collection();
        }
    }

    public function setAnswer(string $question, AnswerChoice $answer, ?int $score = null)
    {
        $isExist = $this->result->where('question_id', $question)
            ->when(in_array($this->assessment->rule->type, ['calculation']), fn($q) => $q->where('answer_choice_id', $answer->id))
            ->first();

        if (!is_null($score) && in_array($this->assessment->rule->type, ['calculation'])) {
            $this->assessment->details()
                ->updateOrCreate(
                    [
                        'question_id' => $question,
                        'answer_choice_id' => $answer->id,
                    ],
                    [
                        'score' => $score
                    ]
                );
        } elseif (in_array($this->assessment->rule->type, ['calculation-2'])) {
            $this->assessment->details()
                ->updateOrCreate(
                    [
                        'question_id' => $question
                    ],
                    [
                        'answer_choice_id' => $answer->id,
                        'score' => collect($this->calculationAnswers)->where('id', $answer->id)->first()['score']
                    ]
                );
        } else {
            $this->assessment->details()
                ->updateOrCreate(
                    [
                        'question_id' => $question
                    ],
                    [
                        'answer_choice_id' => $answer->id,
                        'score' => $this->assessment->rule->type == 'summative' ? 1 : $score
                    ]
                );
        }

        if ($isExist) {
            $this->result = $this->result->map(function ($item) use ($question, $answer, $score) {
                if ($item['question_id'] == $question) {
                    $item['answer_choice_id'] = $answer->id;
                    $item['score'] = $score;
                }

                return $item;
            });
        } else {
            $this->result->push(collect([
                'question_id' => $question,
                'answer_choice_id' => $answer->id,
                'score' => $score
            ]));
        }
    }

    public function setDetailsData()
    {
        if (!$this->assessment->details->count()) {
            if (in_array($this->assessment->rule->type, ['summation', 'summative', 'calculation-2'])) {
                foreach ($this->assessment->quiz->groups as $group)
                    foreach ($group->questions as $question)
                        $this->assessment->details()->create([
                            'question_id' => $question->id,
                            'score' => $this->assessment->rule->type == 'summative' ? 1 : null,
                        ]);
            }

            if (in_array($this->assessment->rule->type, ['group-calculation'])) {
                foreach ($this->assessment->quiz->groups as $group)
                    foreach ($group->questions as $question)
                        $this->assessment->details()->create([
                            'question_id' => $question->id,
                            'score' => 0,
                        ]);
            }

            if (in_array($this->assessment->rule->type, ['calculation'])) {
                foreach ($this->assessment->quiz->groups as $group)
                    foreach ($group->questions as $question)
                        foreach ($question->answers as $answer)
                            $this->assessment->details()->create([
                                'question_id' => $question->id,
                                'answer_choice_id' => $answer->id,
                                'score' => 0,
                            ]);
            }
        }
    }

    public function indexCounter()
    {
        $groupIndexTotal = $this->questions->count() - 1;
        $nowGroupIndex = $this->questions->search(function ($group) {
            return $group['id'] == $this->groupActive['id'];
        });

        $questionIndexTotal = collect($this->questions[$nowGroupIndex]['questions'])->count() - 1;
        $prevQuestionIndexTotal = !empty($this->questions[$nowGroupIndex - 1]) ? collect($this->questions[$nowGroupIndex - 1]['questions'])->count() - 1 : 0;
        $nextQuestionIndexTotal = !empty($this->questions[$nowGroupIndex + 1]) ? collect($this->questions[$nowGroupIndex + 1]['questions'])->count() - 1 : 0;
        $nowQuestionIndex = collect($this->questions[$nowGroupIndex]['questions'])
            ->search(fn($question) => $question['id'] == $this->questionActive['id']);

        return [
            'groupIndexTotal' => $groupIndexTotal,
            'nowGroupIndex' => $nowGroupIndex,
            'questionIndexTotal' => $questionIndexTotal,
            'nowQuestionIndex' => $nowQuestionIndex,
            'prevQuestionIndexTotal' => $prevQuestionIndexTotal,
            'nextQuestionIndexTotal' => $nextQuestionIndexTotal,
        ];
    }

    public function checkNextButton()
    {
        [
            $groupIndexTotal,
            $nowGroupIndex,
            $questionIndexTotal,
            $nowQuestionIndex,
        ] = array_values($this->indexCounter());

        if (($nowQuestionIndex + 1) > $questionIndexTotal) {
            if (($nowGroupIndex + 1) > $groupIndexTotal) {
                $this->nextButton = false;
            } else {
                $this->nextButton = true;
            }
        } else {
            $this->nextButton = true;
        }
    }

    public function checkPrevButton()
    {
        [
            $groupIndexTotal,
            $nowGroupIndex,
            $questionIndexTotal,
            $nowQuestionIndex,
        ] = array_values($this->indexCounter());

        if (($nowQuestionIndex - 1) < 0) {
            if (($nowGroupIndex - 1) < 0) {
                $this->prevButton = false;
            } else {
                $this->prevButton = true;
            }
        } else {
            $this->prevButton = true;
        }
    }

    public function next()
    {
        [
            $groupIndexTotal,
            $nowGroupIndex,
            $questionIndexTotal,
            $nowQuestionIndex,
        ] = array_values($this->indexCounter());

        $nextGroupIndex = 0;
        $nextQuestionIndex = 0;

        if (($nowQuestionIndex + 1) > $questionIndexTotal) {
            if (($nowGroupIndex + 1) > $groupIndexTotal) {
                $nextGroupIndex = $nowGroupIndex;
                $nextQuestionIndex = $nowQuestionIndex;
            } else {
                $nextGroupIndex = $nowGroupIndex + 1;
                $nextQuestionIndex = 0;
            }
        } else {
            $nextGroupIndex = $nowGroupIndex;
            $nextQuestionIndex = $nowQuestionIndex + 1;
        }

        $this->setQuestion(
            $this->questions[$nextGroupIndex]['id'],
            $this->questions[$nextGroupIndex]['questions'][$nextQuestionIndex]['id']
        );
    }

    public function prev()
    {
        [
            $groupIndexTotal,
            $nowGroupIndex,
            $questionIndexTotal,
            $nowQuestionIndex,
            $prevQuestionIndexTotal,
            $nextQuestionIndexTotal,
        ] = array_values($this->indexCounter());

        $prevGroupIndex = 0;
        $prevQuestionIndex = 0;

        if (($nowQuestionIndex - 1) < 0) {
            if (($nowGroupIndex - 1) < 0) {
                $prevGroupIndex = $nowGroupIndex;
                $prevQuestionIndex = $nowQuestionIndex;
            } else {
                $prevGroupIndex = $nowGroupIndex - 1;
                $prevQuestionIndex = $prevQuestionIndexTotal;
            }
        } else {
            $prevGroupIndex = $nowGroupIndex;
            $prevQuestionIndex = $nowQuestionIndex - 1;
        }

        $this->setQuestion(
            $this->questions[$prevGroupIndex]['id'],
            $this->questions[$prevGroupIndex]['questions'][$prevQuestionIndex]['id']
        );
    }

    public function hasDone()
    {
        $this->confirm(
            __('Are you confident that you will complete this assessment?'),
            [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => __('No'),
                'confirmButtonText' => __('Yes'),
                'confirmButtonColor' => '#002A69',
                'cancelButtonColor' => '#d33',
                'customClass' => [
                    'title' => 'text-lg'
                ],
                'onConfirmed' => 'setDone'
            ]
        );
    }

    /**
     * Memeriksa jawaban apakah sudah dilengkapi atau tidak
     *
     * @return bool
     */
    public function checkAnswers()
    {
        if (in_array($this->assessment->rule->type, ['summation', 'group-calculation', 'summative', 'calculation-2'])) {
            return $this->assessment->details->every(fn($q) => !is_null($q->answer_choice_id));
        }

        if ($this->assessment->rule->type == 'calculation') {
            return $this->assessment->details->every(fn($q) => $q->score > 0);
        }
    }

    #[On('setDone')]
    public function done()
    {
        if (!$this->checkAnswers()) {
            $this->alert('warning', __('Please complete your answer choices first'));
            return;
        }
        try {
            AssessmentHelper::getResult($this->assessment, $this->result);
            $this->assessment->update([
                'status' => 3
            ]);

            // dispatch(new AssessmentResultJob(
            //     $this->assessment,
            //     $this->result
            // ));

            $this->dispatch('setStep', step: 3);
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function reorderAnswer($id, $position)
    {
        $arr = $this->calculationAnswers;

        $newItems = new Collection();
        $currentIdx = collect($arr)->where('id', $id)
            ->keys()[0];
        $currentItem = $arr[$currentIdx];
        $newItems[$position] = $currentItem;

        if ($currentIdx < $position + 1) {
            $temp = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx <= $position)
                ->values();
            $temp2 = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx > $position);
            $newTemp = $temp->union($temp2);

            foreach ($newTemp as $idx => $x) {
                $newItems[$idx] = $x;
            }
        } else {
            $temp = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx >= $position);
            $temp2 = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx < $position)->values();
            $newTemp = $temp->union($temp2);
            foreach ($temp as $idx => $x) {
                $newItems[$idx + 1] = $x;
            }

            foreach ($temp2 as $idx => $x) {
                $newItems[$idx] = $x;
            }
        }

        $this->calculationAnswers = $newItems->sortKeys();
        foreach ($newItems as $idx => $item) {
            $this->setAnswer(question: $this->questionActive['id'], answer: $item['id'], score: $idx + 1);
        }
    }
}

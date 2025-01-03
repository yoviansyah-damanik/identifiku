<?php

namespace App\Livewire\Assessment\Step\StepTwo\Rules;

use App\Jobs\AssessmentResultJob;
use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\On;
use App\Models\AnswerChoice;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Calculation extends Component
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
        $this->calculationAnswers = $this->setCalculationAnswers();
    }

    public function render()
    {
        return view('pages.assessment.step.step-two.rules.calculation');
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

        $this->calculationAnswers = $this->setCalculationAnswers();
        $this->checkNextButton();
        $this->checkPrevButton();
    }

    protected function setCalculationAnswers()
    {
        $answers = $this->assessment->refresh()->details->where('question_id', $this->questionActive['id']);
        $result = collect($answers)
            ->map(fn($item, $idx) => [
                'id' => $item->answer_choice_id,
                'score' => $item->score,
                'answer' => $item->answer->text
            ])
            ->sortBy('score')
            ->values();

        foreach ($result as $idx => $item) {
            $this->setAnswer(question: $this->questionActive['id'], answer: $item['id'], score: $idx + 1);
        }
        return $result;
    }

    public function setResult()
    {
        $this->result = $this->assessment->details->count() > 0 ? $this->assessment->details
            ->whereNotNull('answer_choice_id')->map(function ($detail) {
                return collect($detail)->only(['question_id', 'answer_choice_id', 'score']);
            }) : new Collection();
    }

    public function setAnswer(string $question, string $answer, int $score)
    {
        $isExist = $this->result->where('question_id', $question)
            ->where('answer_choice_id', $answer)
            ->first();

        $this->assessment->details()
            ->updateOrCreate(
                [
                    'question_id' => $question,
                    'answer_choice_id' => $answer,
                ],
                [
                    'score' => $score
                ]
            );

        if ($isExist) {
            $this->result = $this->result->map(function ($item) use ($question, $answer, $score) {
                if ($item['question_id'] == $question) {
                    $item['answer_choice_id'] = $answer;
                    $item['score'] = $score;
                }

                return $item;
            });
        } else {
            $this->result->push(collect([
                'question_id' => $question,
                'answer_choice_id' => $answer,
                'score' => $score
            ]));
        }
    }

    public function setDetailsData()
    {
        $data = [];
        if (!$this->assessment->details->count()) {
            foreach ($this->assessment->quiz->groups as $group)
                foreach ($group->questions as $question)
                    $data[] = $question->answers->map(fn($answer) =>
                    [
                        'assessment_id' => $this->assessment->id,
                        'question_id' => $question->id,
                        'answer_choice_id' => $answer->id,
                        'score' => 0,
                    ])->toArray();
            $this->assessment->details()->insert(collect($data)->collapse()->toArray());
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

    #[On('setDone')]
    public function done()
    {
        //   Memeriksa jawaban apakah sudah dilengkapi atau tidak
        if (!$this->assessment->details->every(fn($q) => $q->score > 0)) {
            $this->alert('warning', __('Please complete your answer choices first'));
            return;
        }
        try {
            $this->assessment->update([
                'status' => 2
            ]);
            $this->assessment->result()->updateOrCreate([], [
                'status' => 'process'
            ]);
            dispatch(new AssessmentResultJob($this->assessment, $this->result));

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

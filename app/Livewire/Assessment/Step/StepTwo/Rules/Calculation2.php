<?php

namespace App\Livewire\Assessment\Step\StepTwo\Rules;

use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\On;
use App\Models\AnswerChoice;
use App\Jobs\AssessmentResultJob;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Calculation2 extends Component
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
        $this->calculationAnswers = $this->setCalculation2Answers();
    }

    public function render()
    {
        return view('pages.assessment.step.step-two.rules.calculation2');
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

        $this->calculationAnswers = $this->setCalculation2Answers();
        $this->checkNextButton();
        $this->checkPrevButton();
    }

    protected function setCalculation2Answers()
    {
        $result = collect($this->questionActive['answers'])
            ->map(fn($item, $idx) => [
                'id' => $item['id'],
                'score' => $this->assessment->quiz->groups
                    ->map(
                        fn($group)
                        => $group->questions->where('id', $this->questionActive['id'])
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
        $this->result = $this->assessment->details->count() > 0 ? $this->assessment->details
            ->whereNotNull('answer_choice_id')->map(function ($detail) {
                return collect($detail)->only(['question_id', 'answer_choice_id']);
            }) : new Collection();
    }

    public function setAnswer(string $question, AnswerChoice $answer, ?int $score = null)
    {
        $isExist = $this->result->where('question_id', $question)
            ->first();

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
            foreach ($this->assessment->quiz->groups as $group) {
                $newDetails = $group->questions->map(fn($question) =>
                [
                    'assessment_id' => $this->assessment->id,
                    'question_id' => $question->id,
                    'score' => $this->assessment->rule->type == 'summative' ? 1 : null,
                ])->toArray();
                $this->assessment->details()->insert($newDetails);
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

    #[On('setDone')]
    public function done()
    {
        //   Memeriksa jawaban apakah sudah dilengkapi atau tidak
        if (!$this->assessment->details->every(fn($q) => !is_null($q->answer_choice_id))) {
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
}

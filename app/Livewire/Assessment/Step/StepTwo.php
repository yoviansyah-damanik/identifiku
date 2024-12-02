<?php

namespace App\Livewire\Assessment\Step;

use App\Helpers\AssessmentHelper;
use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\On;
use Livewire\Attributes\Isolate;
use App\Jobs\AssessmentResultJob;
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
                'quiz',
                'quiz.assessmentRule',
                'quiz.groups',
                'quiz.groups.questions',
                'quiz.groups.questions.answers',
            );

        $this->setResult();
        $this->initQuestions();
        $this->setFirstQuestion();

        if (!$assessment->details->count())
            $this->setDetailsData();
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

        $this->checkNextButton();
        $this->checkPrevButton();
    }

    public function setResult()
    {
        if (in_array($this->assessment->quiz->assessmentRule->type, ['summation', 'summative', 'calculation-2'])) {
            $this->result = $this->assessment->details->count() > 0 ? $this->assessment->details
                ->whereNotNull('answer_choice_id')->map(function ($detail) {
                    return collect($detail)->only(['question_id', 'answer_choice_id']);
                }) : new Collection();
        }
    }

    public function setAnswer(string $question, string $answer, ?int $value = null)
    {
        $isExist = $this->result->where('question_id', $question)->first();

        $this->assessment->details()
            ->updateOrCreate(
                [
                    'question_id' => $question
                ],
                [
                    'answer_choice_id' => $answer,
                    'value' => $value
                ]
            );

        if ($isExist) {
            $this->result = $this->result->map(function ($item) use ($question, $answer) {
                if ($item['question_id'] == $question) {
                    $item['answer_choice_id'] = $answer;
                }

                return $item;
            });
        } else {
            $this->result->push(collect([
                'question_id' => $question,
                'answer_choice_id' => $answer
            ]));
        }
        // $this->setQuestions();
    }

    public function setDetailsData()
    {
        if (in_array($this->assessment->quiz->assessmentRule->type, ['summation', 'calculation-2', 'summative'])) {
            foreach ($this->assessment->quiz->groups as $group)
                foreach ($group->questions as $question)
                    $this->assessment->details()->create([
                        'question_id' => $question->id
                    ]);
        }

        if ($this->assessment->quiz->assessmentRule->type == 'calculation') {
            foreach ($this->assessment->quiz->groups as $group)
                foreach ($group->questions as $question)
                    foreach ($question->answers as $answer)
                        $this->assessment->details()->create([
                            'question_id' => $question->id,
                            'answer_choice_id' => $answer->id,
                            'value' => 0
                        ]);
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

    public function render()
    {
        return view('pages.assessment.step.step-two');
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
        if (in_array($this->assessment->quiz->assessmentRule->type, ['summation', 'calculation-2', 'summative'])) {
            return false;
        }
        if ($this->assessment->quiz->assessmentRule->type == 'calculation') {
            return false;
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
}

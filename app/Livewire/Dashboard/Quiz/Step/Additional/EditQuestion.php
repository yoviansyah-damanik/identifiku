<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Question;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditQuestion extends Component
{
    use LivewireAlert;

    public Quiz $quiz;
    public Question $question;

    public string $_question;
    public array $answers;
    public ?bool $isPlus = true;

    public bool $isLoading = true;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.edit-question');
    }

    public function checkCorrectAnswer($currentIdx)
    {
        $currectValue = $this->answers[$currentIdx]['is_correct'];

        $this->answers = collect($this->answers)->map(function ($answer, $idx) use ($currentIdx, $currectValue) {
            $answer['is_correct'] = $idx == $currentIdx ? $currectValue : false;

            return $answer;
        })->toArray();
    }

    public function rules()
    {
        return [
            '_question' => 'required|string',
            'isPlus' => [
                Rule::requiredIf(in_array($this->quiz->assessmentRule->type, ['calculation-2'])),
            ],
            'answers' => 'required|array',
            'answers.*.text' => 'required|string',
            'answers.*.score' => [
                Rule::requiredIf(in_array($this->quiz->assessmentRule->type, ['calculation-2']))
            ],
            // 'answers.*.is_correct' => [
            //     Rule::requiredIf(in_array($this->quiz->assessmentRule->type, ['summative']))
            // ]
        ];
    }

    public function validationAttributes()
    {
        return [
            '_question' => __('Question'),
            'isPlus' => __('Operator'),
            'answers.*.text' => __('Answer'),
            'answers.*.score' => __('Score'),
            'answers.*.is_correct' => __('Correct Answer'),
        ];
    }

    #[On('setEditQuestion')]
    public function setEditQuestion(Question $question)
    {
        $this->isLoading = true;
        $this->question = $question;
        $this->_question = $question->question;
        $this->isPlus = $question->operator == '+' ? true : false;
        $this->refresh();
        $this->isLoading = false;
    }

    public function refresh()
    {
        $this->resetValidation();
        if ($this->quiz->assessmentRule->type == 'summative') {
            $this->answers = $this->quiz->assessmentRule->answers->map(
                fn($q) => [
                    'text' => $q->default,
                    'answer' => $q->answer,
                    'score' => 1,
                    'is_correct' => false,
                ]
            )->toArray();
        } elseif ($this->quiz->assessmentRule->type == 'calculation-2') {
            $this->answers = $this->quiz->assessmentRule->answers->map(
                fn($q) => [
                    'text' => $q->default,
                    'answer' => $q->answer,
                    'score' => $q->score,
                    'is_correct' => false,
                ]
            )->toArray();
        } else {
            $this->answers = $this->quiz->assessmentRule->answers->map(
                fn($q) => [
                    'text' => $q->default,
                    'answer' => $q->answer,
                    'score' => $q->score,
                ]
            )->toArray();
        }
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            if ($this->quiz->assessmentRule->type == 'summative') {
                $isAnswerSelected = collect($this->answers)
                    ->some(fn($answer) => $answer['is_correct'] === true);
                if (!$isAnswerSelected) {
                    $this->alert('warning', __('Please select one of the correct answers first'));
                    $this->isLoading = false;
                    return;
                }
            }

            $operator = $this->isPlus ? '+' : '-';
            $this->question->update([
                'question' => $this->_question,
                'operator' => $operator,
            ]);

            $this->question->answers()->delete();
            foreach ($this->answers as $answer)
                $this->question->answers()->create([
                    'answer' => $answer['answer'],
                    'text' => $answer['text'],
                    'score' => !empty($answer['score']) ? $answer['score'] : null,
                    'is_correct' => !empty($answer['is_correct']) ? $answer['is_correct'] : false,
                ]);

            // $newQuestion->mediables->create([]);

            DB::commit();
            $this->dispatch('toggle-edit-question-modal');
            $this->dispatch('refreshQuizData', group: $this->question->group->id);
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Question')]));
            $this->reset('question', 'answers', '_question');
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

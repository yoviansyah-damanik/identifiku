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

    public bool $isLoading = true;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.edit-question');
    }

    public function rules()
    {
        return [
            '_question' => 'required|string',
            'answers' => 'required|array',
            'answers.*.text' => 'required|string',
            'answers.*.score' => [
                Rule::requiredIf(in_array($this->quiz->assessmentRule->type, ['summative', 'calculation-2']))
            ],
            'answers.*.is_correct' => [
                Rule::requiredIf(in_array($this->quiz->assessmentRule->type, ['summative']))
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            '_question' => __('Question'),
            'answers.*.text' => __('Answer'),
            'answers.*.score' => __('Score'),
            'answers.*.is_correct' => __('Is Correct'),
        ];
    }

    #[On('setEditQuestion')]
    public function setEditQuestion(Question $question)
    {
        $this->isLoading = true;
        $this->question = $question;
        $this->_question = $question->question;
        $this->refresh();
        $this->isLoading = false;
    }

    public function refresh()
    {
        $this->resetValidation();
        if ($this->quiz->assessmentRule->type == 'summative') {
            $this->answers = $this->question->answers->map(
                fn($q) => [
                    'text' => $q->text,
                    'answer' => $q->answer,
                    'score' => $q->score,
                    'is_correct' => $q->is_correct
                ]
            )->toArray();
        } elseif ($this->quiz->assessmentRule->type == 'calculation-2') {
            $this->answers = $this->question->answers->map(
                fn($q) => [
                    'text' => $q->text,
                    'answer' => $q->answer,
                    'score' => $q->score,
                ]
            )->toArray();
        } else {
            $this->answers = $this->question->answers->map(
                fn($q) => [
                    'text' => $q->text,
                    'answer' => $q->answer
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
            $this->question->update([
                'question' => $this->_question,
            ]);

            $this->question->answers()->delete();
            foreach ($this->answers as $answer)
                $this->question->answers()->create([
                    'answer' => $answer['answer'],
                    'text' => $answer['text'],
                    'score' => !empty($answer['score']) ? $answer['score'] : null,
                    'is_correct' => !empty($answer['is_correct']) ? $answer['is_correct'] : null,
                ]);

            // $newQuestion->mediables->create([]);

            DB::commit();
            $this->dispatch('toggle-edit-question-modal');
            $this->dispatch('refreshQuizData', group: $this->question->group->id);
            $this->dispatch('refreshGroupData');
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

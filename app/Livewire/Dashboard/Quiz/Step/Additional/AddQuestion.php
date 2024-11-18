<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Question;
use Livewire\Attributes\On;
use App\Models\QuestionGroup;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddQuestion extends Component
{
    use LivewireAlert;
    public Quiz $quiz;
    public QuestionGroup $group;
    public string $question;
    public array $answers;

    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.add-question');
    }

    public function rules()
    {
        return [
            'question' => 'required|string',
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
            'question' => __('Question'),
            'answers.*.text' => __('Answer'),
            'answers.*.score' => __('Score'),
            'answers.*.is_correct' => __('Is Correct'),
        ];
    }

    #[On('setAddQuestion')]
    public function setAddQuestion(QuestionGroup $group)
    {
        $this->isLoading = true;
        $this->group = $group;
        $this->refresh();
        $this->isLoading = false;
    }

    public function refresh()
    {
        $this->resetValidation();
        if ($this->quiz->assessmentRule->type == 'summative') {
            $this->answers = $this->quiz->assessmentRule->details->map(
                fn($q) => [
                    'text' => $q->default,
                    'answer' => $q->answer,
                    'score' => null,
                    'is_correct' => false
                ]
            )->toArray();
        } elseif ($this->quiz->assessmentRule->type == 'calculation-2') {
            $this->answers = $this->quiz->assessmentRule->details->map(
                fn($q) => [
                    'text' => $q->default,
                    'answer' => $q->answer,
                    'score' => null
                ]
            )->toArray();
        } else {
            $this->answers = $this->quiz->assessmentRule->details->map(
                fn($q) => [
                    'text' => $q->default,
                    'answer' => $q->answer
                ]
            )->toArray();
        }
    }

    public function add()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $newQuestion = Question::create([
                'question_group_id' => $this->group->id,
                'question' => $this->question,
                'order' => $this->group->questions->count() + 1
            ]);

            foreach ($this->answers as $answer)
                $newQuestion->answers()->create([
                    'answer' => $answer['answer'],
                    'text' => $answer['text'],
                    'score' => !empty($answer['score']) ? $answer['score'] : null,
                    'is_correct' => !empty($answer['is_correct']) ? $answer['is_correct'] : null,
                ]);

            // $newQuestion->mediables->create([]);

            DB::commit();
            $this->dispatch('toggle-add-question-modal');
            $this->dispatch('refreshQuizData', group: $this->group->id);
            $this->reset('question', 'group', 'answers');
            $this->alert('success', __(':attribute added successfully.', ['attribute' => __('Question')]));
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

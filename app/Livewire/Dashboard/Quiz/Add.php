<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\ClassHasQuiz;
use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Add extends Component
{
    use LivewireAlert;
    public Quiz $quiz;

    public bool $isLoading = true;

    public array $studentClasses;
    public string $studentClassSearch = '';
    public string $studentClass = '';

    public function mount()
    {
        $this->studentClasses();
    }

    public function render()
    {
        return view('pages.dashboard.quiz.add');
    }

    public function rules()
    {
        return [
            'studentClass' => 'required|exists:student_classes,id',
        ];
    }

    public function validationAttributes()
    {
        return [
            'studentClass' => __('Student Class')
        ];
    }

    public function studentClasses()
    {
        $this->studentClasses = StudentClass::where('name', 'like', '%' . $this->studentClassSearch . '%')
            ->where('teacher_id', auth()->user()->teacher->id)
            ->limit(10)
            ->get()
            ->map(fn($studentClass) => [
                'title' => $studentClass->name,
                'value' => $studentClass->id,
                'description' => $studentClass->description,
            ])
            ->toArray();
    }

    public function setSearchStudentClassSearch($data)
    {
        $this->studentClassSearch = $data;
        $this->studentClasses();
    }

    public function setValueStudentClass($data)
    {
        $this->studentClass = $data;
    }

    public function resetValueStudentClass()
    {
        $this->reset('studentClass', 'studentClassSearch');
    }

    #[On('setAddQuiz')]
    public function setAddQuiz(Quiz $quiz)
    {
        $this->isLoading = true;
        $this->quiz = $quiz;
        $this->isLoading = false;
    }

    public function refresh()
    {
        $this->resetValueStudentClass();
        $this->dispatch('resetValueStudentClass');
    }

    public function add()
    {
        // $this->authorize('add');
        $this->validate();
        $this->isLoading = true;
        try {
            if (in_array($this->studentClass, $this->quiz->hasClasses->pluck('student_class_id')->toArray())) {
                $this->alert('warning', __('This quiz has been added to the class'));
                $this->isLoading = false;
                return;
            }

            ClassHasQuiz::create([
                'student_class_id' => $this->studentClass,
                'quiz_id' => $this->quiz->id
            ]);

            $this->refresh();
            $this->dispatch('toggle-add-quiz-modal');
            $this->alert('success', __(':attribute added successfully.', ['attribute' => __('Quiz')]));
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

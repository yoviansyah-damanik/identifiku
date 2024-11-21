<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentClass;

class Add extends Component
{
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

    public function add()
    {
        // $this->authorize('add');
        try {
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}

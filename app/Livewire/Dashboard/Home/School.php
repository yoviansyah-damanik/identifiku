<?php

namespace App\Livewire\Dashboard\Home;

use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Assessment;
use App\Models\StudentClass;
use App\Models\StudentRequest;
use App\Models\TeacherRequest;

class School extends Component
{
    public function render()
    {
        $students_count = Student::count();
        $teachers_count = Teacher::count();
        $student_requests_count = StudentRequest::count();
        $classes_count = StudentClass::whereIn('id', auth()->user()->school->classes->pluck('id')->toArray())->count();

        $student_requests_count = StudentRequest::where('school_id', auth()->user()->school->id)->count();
        $teacher_requests_count = TeacherRequest::where('school_id', auth()->user()->school->id)->count();

        $quizzes_count = Quiz::published()->count();
        $assessments_count = Assessment::whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->school->classes->pluck('id')->toArray()))->count();

        $five_recent_of_student_learning_style = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'studentLearningStyle'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->school->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_personality_type = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'personalityType'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->school->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_keirsey_temperament_sorter = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'keirseyTemperamentSorter'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->school->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_multiple_intelligence_type = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'multipleIntelligenceType'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->school->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $data = [
            'students_count' => $students_count,
            'teachers_count' => $teachers_count,
            'assessments_count' => $assessments_count,
            'classes_count' => $classes_count,
            'quizzes_count' => $quizzes_count,
            'student_requests_count' => $student_requests_count,
            'teacher_requests_count' => $teacher_requests_count,
            'five_recent_of_student_learning_style' => $five_recent_of_student_learning_style,
            'five_recent_of_personality_type' => $five_recent_of_personality_type,
            'five_recent_of_keirsey_temperament_sorter' => $five_recent_of_keirsey_temperament_sorter,
            'five_recent_of_multiple_intelligence_type' => $five_recent_of_multiple_intelligence_type,
        ];
        return view('pages.dashboard.home.school', $data);
    }
}

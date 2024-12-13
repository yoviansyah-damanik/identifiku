<?php

namespace App\Livewire\Dashboard\Home;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Assessment;
use App\Models\ClassRequest;
use App\Models\StudentClass;

class Teacher extends Component
{
    public function render()
    {
        $teacher_id = auth()->user()->teacher->id;

        $classes_count = StudentClass::where('teacher_id', $teacher_id)->count();
        $class_requests_count = ClassRequest::whereHas('teacher', fn($q) => $q->where('teacher_id', $teacher_id))->count();

        $available_quizzes_count = Quiz::published()->count();

        $assessments_count = Assessment::whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->teacher->classes->pluck('id')->toArray()))->count();

        $five_recent_of_student_learning_style = Assessment::with(['quiz', 'student', 'class', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'studentLearningStyle'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->teacher->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_personality_type = Assessment::with(['quiz', 'student', 'class', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'personalityType'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->teacher->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_keirsey_temperament_sorter = Assessment::with(['quiz', 'student', 'class', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'keirseyTemperamentSorter'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->teacher->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_multiple_intelligence_type = Assessment::with(['quiz', 'student', 'class', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'multipleIntelligenceType'))
            ->whereHas('class', fn($q) => $q->whereIn('id', auth()->user()->teacher->classes->pluck('id')->toArray()))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $data = [
            'classes_count' => $classes_count,
            'class_requests_count' => $class_requests_count,
            'assessments_count' => $assessments_count,
            'available_quizzes_count' => $available_quizzes_count,
            'five_recent_of_student_learning_style' => $five_recent_of_student_learning_style,
            'five_recent_of_personality_type' => $five_recent_of_personality_type,
            'five_recent_of_keirsey_temperament_sorter' => $five_recent_of_keirsey_temperament_sorter,
            'five_recent_of_multiple_intelligence_type' => $five_recent_of_multiple_intelligence_type,
        ];

        return view('pages.dashboard.home.teacher', $data);
    }
}

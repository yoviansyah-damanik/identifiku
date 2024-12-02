<?php

namespace App\Livewire\Dashboard\Home;

use App\Models\Quiz;
use App\Models\Region;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\QuizPhase;
use App\Models\Assessment;
use App\Models\ClassRequest;
use App\Models\GradeLevel;
use App\Models\QuizCategory;
use App\Models\SchoolStatus;
use App\Models\SchoolRequest;
use App\Models\EducationLevel;
use App\Models\StudentClass;
use App\Models\StudentRequest;
use App\Models\TeacherRequest;

class Administrator extends Component
{
    public function render()
    {
        $students_count = Student::count();
        $teachers_count = Teacher::count();
        $schools_count = School::count();
        $classes_count = StudentClass::count();

        $student_requests_count = StudentRequest::count();
        $teacher_requests_count = TeacherRequest::count();
        $school_requests_count = SchoolRequest::count();
        $class_requests_count = ClassRequest::count();

        $education_levels_count = EducationLevel::count();
        $grade_levels_count = GradeLevel::count();
        $school_statuses_count = SchoolStatus::count();

        $quiz_categories_count = QuizCategory::count();
        $quiz_phases_count = QuizPhase::count();

        $quizzes_count = Quiz::count();
        $draft_quizzes_count = Quiz::draft()->count();
        $published_quizzes_count = Quiz::published()->count();

        $assessments_count = Assessment::count();
        $process_assessments_count = Assessment::process()->count();
        $submitted_assessments_count = Assessment::submitted()->count();
        $completed_assessments_count = Assessment::done()->count();

        $five_recent_of_student_learning_style = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'studentLearningStyle'))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_personality_type = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'personalityType'))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_keirsey_temperament_sorter = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'keirseyTemperamentSorter'))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $five_recent_of_multiple_intelligence_type = Assessment::with(['quiz', 'student', 'student.school', 'result', 'result.details'])
            ->whereHas('quiz', fn($q) => $q->where('type', 'multipleIntelligenceType'))
            ->done()
            ->latest()
            ->limit(5)
            ->get();

        $data = [
            'students_count' => $students_count,
            'teachers_count' => $teachers_count,
            'schools_count' => $schools_count,
            'classes_count' => $classes_count,
            'student_requests_count' => $student_requests_count,
            'teacher_requests_count' => $teacher_requests_count,
            'school_requests_count' => $school_requests_count,
            'class_requests_count' => $class_requests_count,
            'education_levels_count' => $education_levels_count,
            'grade_levels_count' => $grade_levels_count,
            'school_statuses_count' => $school_statuses_count,
            'quiz_categories_count' => $quiz_categories_count,
            'quiz_phases_count' => $quiz_phases_count,
            'quizzes_count' => $quizzes_count,
            'draft_quizzes_count' => $draft_quizzes_count,
            'published_quizzes_count' => $published_quizzes_count,
            'assessments_count' => $assessments_count,
            'process_assessments_count' => $process_assessments_count,
            'submitted_assessments_count' => $submitted_assessments_count,
            'completed_assessments_count' => $completed_assessments_count,
            'five_recent_of_student_learning_style' => $five_recent_of_student_learning_style,
            'five_recent_of_personality_type' => $five_recent_of_personality_type,
            'five_recent_of_keirsey_temperament_sorter' => $five_recent_of_keirsey_temperament_sorter,
            'five_recent_of_multiple_intelligence_type' => $five_recent_of_multiple_intelligence_type,
        ];

        if (auth()->user()->roleName == 'Superadmin') {
            $provinces_count = Region::province()->count();
            $regencies_count = Region::regency()->count();
            $districts_count = Region::district()->count();
            $villages_count = Region::village()->count();

            $data += [
                'provinces_count' => $provinces_count,
                'regencies_count' => $regencies_count,
                'districts_count' => $districts_count,
                'villages_count' => $villages_count
            ];
        }

        return view('pages.dashboard.home.administrator', $data);
    }
}

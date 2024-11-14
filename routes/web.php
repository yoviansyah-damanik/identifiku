<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Main\Index::class)
    ->name('home');
Route::get('/article', \App\Livewire\Main\Article\Index::class)
    ->name('article');
Route::get('/article/{article:slug}', \App\Livewire\Main\Article\Show::class)
    ->name('article.show');
Route::get('/assessment', \App\Livewire\Main\Assessment\Index::class)
    ->name('assessment');
Route::get('/assessment/{quiz}', \App\Livewire\Main\Assessment\Show::class)
    ->name('assessment.show');
Route::get('/assessment/{quiz}/preview', \App\Livewire\Main\Assessment\Preview::class)
    ->name('assessment.preview');
// Route::get('/assessment/play/{quiz}', \App\Livewire\Main\Assessment\Show::class)
//     ->name('assessment.play');
Route::get('/about', \App\Livewire\Main\About::class)
    ->name('about');

Route::middleware('guest')
    ->group(function () {
        Route::get('/login', \App\Livewire\Auth\Login::class)
            ->name('login');
        Route::get('/registration', \App\Livewire\Auth\Registration::class)
            ->name('registration');
        Route::get('/registration/school', \App\Livewire\Auth\RegistrationStep\SchoolRegistration::class)
            ->name('registration.school');
        Route::get('/registration/student', \App\Livewire\Auth\RegistrationStep\StudentRegistration::class)
            ->name('registration.student');
        Route::get('/registration/student/{school}/{token}', \App\Livewire\Auth\RegistrationStep\StudentRegistrationFinal::class)
            ->name('registration.student.final');
        Route::get('/registration/teacher', \App\Livewire\Auth\RegistrationStep\TeacherRegistration::class)
            ->name('registration.teacher');
        Route::get('/registration/teacher/{school}/{token}', \App\Livewire\Auth\RegistrationStep\TeacherRegistrationFinal::class)
            ->name('registration.teacher.final');
        Route::get('/forgot-password', \App\Livewire\Auth\ForgotPassword::class)
            ->name('forgot-password');
        Route::get('/reset-password/{token}', \App\Livewire\Auth\ResetPassword::class)
            ->name('reset-password');
    });

Route::middleware('auth')
    ->group(function () {});

Route::prefix('dashboard')
    ->as('dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', \App\Livewire\Dashboard\Index::class);
        Route::get('/school', \App\Livewire\Dashboard\School\Index::class)
            ->middleware('permission:school')
            ->name('.school');
        Route::get('/school-request', \App\Livewire\Dashboard\SchoolRequest\Index::class)
            ->middleware('permission:school request')
            ->name('.school-request');
        Route::get('/student', \App\Livewire\Dashboard\Student\Index::class)
            ->middleware('permission:student')
            ->name('.student');
        Route::get('/student-request', \App\Livewire\Dashboard\StudentRequest\Index::class)
            ->middleware('permission:student request')
            ->name('.student-request');
        Route::get('/teacher', \App\Livewire\Dashboard\Teacher\Index::class)
            ->middleware('permission:teacher')
            ->name('.teacher');
        Route::get('/teacher-request', \App\Livewire\Dashboard\TeacherRequest\Index::class)
            ->middleware('permission:teacher request')
            ->name('.teacher-request');

        Route::get('/assessment', \App\Livewire\Dashboard\Assessment\Index::class)
            ->middleware('permission:assessment')
            ->name('.assessment');
        Route::get('/assessment-history', \App\Livewire\Dashboard\Assessment\History::class)
            ->middleware('permission:assessment history')
            ->name('.assessment-history');
        Route::get('/student-assessments', \App\Livewire\Dashboard\Assessment\Students::class)
            ->middleware('permission:assessment students')
            ->name('.assessment-students');

        Route::get('/education-level', \App\Livewire\Dashboard\EducationLevel\Index::class)
            ->middleware('permission:educationLevel')
            ->name('.education-level');
        Route::get('/grade-level', \App\Livewire\Dashboard\GradeLevel\Index::class)
            ->middleware('permission:gradeLevel')
            ->name('.grade-level');
        Route::get('/school-status', \App\Livewire\Dashboard\SchoolStatus\Index::class)
            ->middleware('permission:schoolStatus')
            ->name('.school-status');

        // Route::get('/question', \App\Livewire\Dashboard\Question\Index::class)
        //     ->name('.question');
        // Route::get('/question-group', \App\Livewire\Dashboard\QuestionGroup\Index::class)
        //     ->name('.question-group');
        // Route::get('/question-type', \App\Livewire\Dashboard\QuestionType\Index::class)
        //     ->name('.question-type');

        Route::get('/class', \App\Livewire\Dashboard\Class\Index::class)
            ->middleware('permission:class')
            ->name('.class');
        Route::get('/class/show/{class}', \App\Livewire\Dashboard\Class\Show::class)
            ->middleware('permission:class show')
            ->name('.class.show');
        Route::get('/class/request', \App\Livewire\Dashboard\Class\Request::class)
            ->middleware('permission:class request')
            ->name('.class.request');

        Route::get('/student-class', \App\Livewire\Dashboard\StudentClass\Index::class)
            ->middleware('permission:class student')
            ->name('.student-class');
        Route::get('/student-class/available', \App\Livewire\Dashboard\StudentClass\Available::class)
            ->middleware('permission:class available')
            ->name('.student-class.available');
        Route::get('/student-class/show/{class}', \App\Livewire\Dashboard\StudentClass\Show::class)
            ->middleware('permission:class student show')
            ->name('.student-class.show');
        Route::get('/student-class/show/{class}/{quiz}', \App\Livewire\Dashboard\StudentClass\ShowQuiz::class)
            ->middleware('permission:class student show')
            ->name('.student-class.show.quiz');

        Route::get('/quiz', \App\Livewire\Dashboard\Quiz\Index::class)
            ->middleware('permission:quiz')
            ->name('.quiz');
        Route::get('/quiz/available', \App\Livewire\Dashboard\Quiz\Available::class)
            ->middleware('permission:quiz available')
            ->name('.quiz.available');
        Route::get('/quiz/create', \App\Livewire\Dashboard\Quiz\Create::class)
            ->middleware('permission:quiz create')
            ->name('.quiz.create');
        Route::get('/quiz/show/{quiz}', \App\Livewire\Dashboard\Quiz\Show::class)
            ->middleware('permission:quiz show')
            ->name('.quiz.show');
        Route::get('/quiz/show/{quiz}/preview', \App\Livewire\Dashboard\Quiz\Preview::class)
            ->middleware('permission:quiz show')
            ->name('.quiz.preview');
        Route::get('/quiz/{quiz:id}', \App\Livewire\Dashboard\Quiz\Edit::class)
            ->middleware('permission:quiz edit')
            ->name('.quiz.edit');

        Route::get('/quiz-category', \App\Livewire\Dashboard\QuizCategory\Index::class)
            ->middleware('permission:quiz category')
            ->name('.quiz-category');
        Route::get('/quiz-phase', \App\Livewire\Dashboard\QuizPhase\Index::class)
            ->middleware('permission:quiz phase')
            ->name('.quiz-phase');

        Route::get('/region', \App\Livewire\Dashboard\Region\Index::class)
            ->middleware('permission:region')
            ->name('.region');
        Route::get('/users', \App\Livewire\Dashboard\Users\Index::class)
            ->middleware('permission:users')
            ->name('.users');
        Route::get('/account', \App\Livewire\Dashboard\Account\Index::class)
            ->middleware('permission:account')
            ->name('.account');
        Route::get('/general', \App\Livewire\Dashboard\General::class)
            ->middleware('permission:general')
            ->name('.general');
    });

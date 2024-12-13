<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassHasQuiz;
use App\Models\StudentClass;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $class = StudentClass::create([
            'name' => 'Tes Kelas',
            'description' => 'Simulasi IdentifiKu',
            'teacher_id' => User::role('Teacher')->first()->teacher->id,
            'is_active' => true
        ]);

        foreach (Student::all() as $student)
            $student->hasClasses()->create([
                'student_class_id' => $class->id
            ]);

        foreach (Quiz::all() as $quiz)
            $class->hasQuizzes()->create([
                'quiz_id' => $quiz->id
            ]);
    }
}

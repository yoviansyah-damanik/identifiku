<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'assessment']);
        Permission::create(['name' => 'assessmentHistory']);

        Permission::create(['name' => 'school']);
        Permission::create(['name' => 'teacher']);
        Permission::create(['name' => 'student']);

        Permission::create(['name' => 'schoolRequest']);
        Permission::create(['name' => 'teacherRequest']);
        Permission::create(['name' => 'studentRequest']);

        Permission::create(['name' => 'educationLevel']);
        Permission::create(['name' => 'gradeLevel']);
        Permission::create(['name' => 'schoolStatus']);

        Permission::create(['name' => 'class']);
        Permission::create(['name' => 'studentClass']);

        Permission::create(['name' => 'quiz']);
        Permission::create(['name' => 'quizCategory']);
        Permission::create(['name' => 'quizPhase']);

        Permission::create(['name' => 'region']);
        Permission::create(['name' => 'users']);

        Role::create(['name' => 'Superadmin'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'Administrator'])
            ->givePermissionTo(Permission::whereNotIn(
                'name',
                ['users', 'region']
            )->get());

        Role::create(['name' => 'School'])
            ->givePermissionTo(Permission::whereIn(
                'name',
                ['student', 'studentRequest', 'teacher', 'teacherRequest', 'class']
            )->get());

        Role::create(['name' => 'Student'])
            ->givePermissionTo(Permission::whereIn(
                'name',
                ['assessmentHistory', 'studentClass']
            )->get());

        Role::create(['name' => 'Teacher'])
            ->givePermissionTo(Permission::whereIn(
                'name',
                ['asssessment', 'assessmentHistory', 'class']
            )->get());
    }
}

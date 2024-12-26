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
        Permission::create(['name' => 'assessment history']);
        Permission::create(['name' => 'assessment students']);
        Permission::create(['name' => 'assessment play']);
        Permission::create(['name' => 'assessment result']);

        Permission::create(['name' => 'school']);
        Permission::create(['name' => 'school request']);

        Permission::create(['name' => 'teacher']);
        Permission::create(['name' => 'teacher request']);

        Permission::create(['name' => 'student']);
        Permission::create(['name' => 'student request']);

        Permission::create(['name' => 'educationLevel']);
        Permission::create(['name' => 'educationLevel create']);
        Permission::create(['name' => 'educationLevel edit']);
        Permission::create(['name' => 'educationLevel delete']);

        Permission::create(['name' => 'gradeLevel']);
        Permission::create(['name' => 'gradeLevel create']);
        Permission::create(['name' => 'gradeLevel edit']);
        Permission::create(['name' => 'gradeLevel delete']);

        Permission::create(['name' => 'schoolStatus']);
        Permission::create(['name' => 'schoolStatus create']);
        Permission::create(['name' => 'schoolStatus edit']);
        Permission::create(['name' => 'schoolStatus delete']);

        Permission::create(['name' => 'class']);
        Permission::create(['name' => 'class create']);
        Permission::create(['name' => 'class edit']);
        Permission::create(['name' => 'class delete']);
        Permission::create(['name' => 'class show']);
        Permission::create(['name' => 'class show quiz']);
        Permission::create(['name' => 'class show addStudent']);
        Permission::create(['name' => 'class request']);
        Permission::create(['name' => 'class student']);
        Permission::create(['name' => 'class student show']);
        Permission::create(['name' => 'class available']);

        Permission::create(['name' => 'quiz']);
        Permission::create(['name' => 'quiz add']);
        Permission::create(['name' => 'quiz create']);
        Permission::create(['name' => 'quiz edit']);
        Permission::create(['name' => 'quiz delete']);
        Permission::create(['name' => 'quiz forceDelete']);
        Permission::create(['name' => 'quiz show']);
        Permission::create(['name' => 'quiz available']);
        Permission::create(['name' => 'quiz category']);
        Permission::create(['name' => 'quiz phase']);

        Permission::create(['name' => 'region']);
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'users forgotPassword']);
        Permission::create(['name' => 'users activationMenu']);
        Permission::create(['name' => 'general']);
        Permission::create(['name' => 'account']);

        $studentPermissions = [
            'assessment',
            'assessment history',
            'assessment play',
            'assessment result',
            'class student',
            'class student show',
            'class available',
            'quiz available',
            'quiz show',
            'account'
        ];

        $schoolPermissions = [
            'assessment students',
            'assessment result',
            'student',
            'student request',
            'teacher',
            'teacher request',
            'class',
            'class show',
            'class request',
            'class show quiz',
            'quiz available',
            'quiz show',
            'account'
        ];

        $teacherPermissions = [
            'assessment students',
            'assessment result',
            'student',
            'class',
            'class request',
            'class create',
            'class edit',
            'class delete',
            'class show',
            'class show quiz',
            'quiz add',
            'quiz available',
            'quiz show',
            'account'
        ];

        Role::create(['name' => 'Superadmin'])
            ->givePermissionTo(Permission::whereNotIn(
                'name',
                [
                    'class create',
                    'class available',
                    'class student',
                    'class student show',
                    'assessment play',
                    'quiz available',
                    'assessment',
                    'assessment history',
                ]
            )->get());

        Role::create(['name' => 'Administrator'])
            ->givePermissionTo(Permission::whereNotIn(
                'name',
                [
                    'users',
                    'region',
                    'class create',
                    'class available',
                    'class student',
                    'class student show',
                    'assessment play',
                    'quiz available',
                    'assessment',
                    'assessment history',
                ]
            )->get());

        Role::create(['name' => 'School'])
            ->givePermissionTo(Permission::whereIn(
                'name',
                $schoolPermissions
            )->get());

        Role::create(['name' => 'Student'])
            ->givePermissionTo(Permission::whereIn(
                'name',
                $studentPermissions
            )->get());

        Role::create(['name' => 'Teacher'])
            ->givePermissionTo(Permission::whereIn(
                'name',
                $teacherPermissions
            )->get());
    }
}

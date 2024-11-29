<?php

namespace App\Policies;

use App\Models\StudentClass;
use App\Models\User;

class StudentClassPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StudentClass $class): bool
    {
        if ($user->isStudent) {
            return $class->is_active && in_array($class->id, $user->student->hasClasses->pluck('student_class_id')->toArray());
        }

        if ($user->isTeacher) {
            return $class->is_active;
        }

        if ($user->isSchool) {
            return $class->is_active;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isTeacher;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StudentClass $studentClass): bool
    {
        return $user->isTeacher && $studentClass->teacher_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StudentClass $studentClass): bool
    {
        return $user->isTeacher && $studentClass->teacher_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StudentClass $studentClass): bool
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StudentClass $studentClass): bool
    {
        return $user->isAdmin;
    }

    public function join(User $user, StudentClass $studentClass): bool
    {
        return $user->isStudent && ($user->student->school_id === $studentClass->teacher->school->id);
    }

    public function cancel(User $user, StudentClass $studentClass): bool
    {
        return $user->isStudent && ($user->student->school_id === $studentClass->teacher->school->id);
    }
}

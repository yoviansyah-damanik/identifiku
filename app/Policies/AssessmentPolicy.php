<?php

namespace App\Policies;

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssessmentPolicy
{
    public function result(User $user, Assessment $assessment): bool
    {
        if ($user->isStudent) {
            return $assessment->student_id == $user->student->id;
        }

        if ($user->isTeacher) {
            return $assessment->class->teacher_id == $user->teacher->id;
        }

        if ($user->isSchool) {
            return $assessment->class->teacher->school_id == $user->school->id;
        }

        return true;
    }

    public function play(User $user, Assessment $assessment): bool
    {
        if (!$assessment->class->isStatusActive)
            return false;

        return $user->isStudent && $user->student->id == $assessment->student_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Assessment $assessment): bool
    {
        return $user->isStudent && (!$assessment->isDone && $user->student->id == $assessment->student_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isStudent;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Assessment $assessment): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Assessment $assessment): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Assessment $assessment): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Assessment $assessment): bool
    {
        //
    }
}

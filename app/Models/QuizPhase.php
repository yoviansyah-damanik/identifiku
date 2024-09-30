<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class QuizPhase extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(QuizPhaseDetail::class, 'quiz_phase_id', 'id');
    }

    public function grades(): HasManyThrough
    {
        return $this->hasManyThrough(GradeLevel::class, QuizPhaseDetail::class, 'quiz_phase_id', 'id', 'id', 'grade_level_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassHasQuiz extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id', 'id');
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
}

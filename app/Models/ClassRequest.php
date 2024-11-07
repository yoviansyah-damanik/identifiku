<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class ClassRequest extends Model
{
    protected $guarded = ['id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id', 'id');
    }

    public function teacher(): HasOneThrough
    {
        return $this->hasOneThrough(Teacher::class, StudentClass::class, 'id', 'id', 'student_class_id', 'teacher_id');
    }
}

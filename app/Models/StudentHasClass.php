<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentHasClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function studentClass(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class StudentClass extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];
    // protected $appends = ['isStatusActive'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }

    public function isStatusActive(): Attribute
    {
        return new Attribute(
            get: fn() => $this->is_active ? ($this->expired_at ?  $this->expired_at >= \Carbon\Carbon::now() : $this->is_active) : false
        );
    }

    public function isLimit(): Attribute
    {
        return new Attribute(
            get: fn() => $this->expired_at ?  $this->expired_at < \Carbon\Carbon::now() : false
        );
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function studentsHasClass(): HasMany
    {
        return $this->hasMany(StudentHasClass::class);
    }

    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(Student::class, StudentHasClass::class, 'student_class_id', 'id', 'id', 'student_id');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(ClassHasQuiz::class);
    }
}

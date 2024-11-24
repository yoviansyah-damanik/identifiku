<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class StudentClass extends Model
{
    use HasFactory, HasUuids, Sluggable;

    protected $guarded = ['id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

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

    public function studentHasClasses(): HasMany
    {
        return $this->hasMany(StudentHasClass::class);
    }

    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(Student::class, StudentHasClass::class, 'student_class_id', 'id', 'id', 'student_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function hasQuizzes(): HasMany
    {
        return $this->hasMany(ClassHasQuiz::class);
    }

    public function quizzes(): HasManyThrough
    {
        return $this->hasManyThrough(Quiz::class, ClassHasQuiz::class, 'student_class_id', 'id', 'id', 'quiz_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Assessment extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];
    protected $with = ['quiz'];

    protected function casts(): array
    {
        return [
            'started_on' => 'datetime',
        ];
    }

    public function scopeProcess($query)
    {
        $query->where('status', 1);
    }

    public function scopeSubmitted($query)
    {
        $query->where('status', 2);
    }

    public function scopeDone($query)
    {
        $query->where('status', 3);
    }

    public function isStillPlay(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->started_on != null && (now() > $this->started_on->addMinutes($this->quiz->estimation_time)))
                    return false;

                return true;
            }
        );
    }

    public function isProcess(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status == 1
        );
    }

    public function isSubmitted(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status == 2
        );
    }

    public function isDone(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status == 3
        );
    }

    public function remainingTime(): Attribute
    {
        return new Attribute(
            get: fn() => $this->started_on ? (now() > $this->started_on->addMinutes($this->quiz->estimation_time) ? 0 : floor(now()->diffInMinutes($this->started_on->addMinutes($this->quiz->estimation_time)))) : null
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id')
            ->withTrashed();
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id', 'id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(AssessmentDetail::class, 'assessment_id', 'id');
    }

    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }

    public function rule(): HasOneThrough
    {
        return $this->hasOneThrough(AssessmentRule::class, Quiz::class, 'id', 'quiz_id', 'quiz_id', 'id');
    }
}

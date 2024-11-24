<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function scopeDone($query)
    {
        $query->where('status', 'done');
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

    public function isDone(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status == 'done'
        );
    }

    public function remainingTime(): Attribute
    {
        return new Attribute(
            get: fn() => is_null($this->started_on) ? $this->quiz->estimation_time : $this->started_on->addMinutes($this->quiz->estimation_time) - now()
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id', 'id');
    }
}

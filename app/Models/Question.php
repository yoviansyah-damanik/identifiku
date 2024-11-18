<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Question extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(QuestionGroup::class, 'question_group_id', 'id');
    }

    public function mediables(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AnswerChoice::class);
    }
}

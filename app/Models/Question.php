<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Question extends Model
{
    use HasFactory, HasUuids;

    public function group(): BelongsTo
    {
        return $this->belongsTo(QuestionGroup::class);
    }

    public function mediables(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}

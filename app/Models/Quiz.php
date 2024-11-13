<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Quiz extends Model
{
    use HasFactory, HasUuids, SoftDeletes, Sluggable;

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

    public function scopePublished(Builder $query)
    {
        $query->where('status', 'published')
            ->where('is_active', true);
    }

    public function questionsTotal(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->types->sum('questionsTotal');
            }
        );
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(QuizDetail::class);
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(QuizPhase::class, 'quiz_phase_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(QuizCategory::class, 'quiz_category_id', 'id');
    }

    public function picture(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('type', 'picture');
    }

    public function types(): HasManyThrough
    {
        return $this->hasManyThrough(QuestionType::class, QuizDetail::class, 'quiz_id', 'id', 'id', 'question_type_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Result extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function dominance(): Attribute
    {
        return new Attribute(
            get: function () {
                // if (in_array($this->quiz->assessmentRule->type, ['calculation']))
                //     return $this->details->where('is_highlight', true)->first();

                // if (in_array($this->quiz->assessmentRule->type, ['summation', 'summative']))
                //     return $this->details->where('is_highlight', true)->first();

                // if (in_array($this->quiz->assessmentRule->type, ['group-calculation']))
                return $this->details->where('is_highlight', true)->first();
            }
        );
    }

    public function details(): HasMany
    {
        return $this->hasMany(ResultDetail::class, 'result_id', 'id')
            ->orderBy('score', 'desc');
    }

    public function quiz(): HasOneThrough
    {
        return $this->hasOneThrough(Quiz::class, Assessment::class, 'id', 'id', 'assessment_id', 'quiz_id');
    }
}

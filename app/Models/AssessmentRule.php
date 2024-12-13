<?php

namespace App\Models;

use App\Helpers\QuizHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentRule extends Model
{
    protected $guarded = ['id'];
    // protected $appends = ['typeName'];

    public function getTypeNameAttribute()
    {
        return collect(QuizHelper::getAssessmentRuleType())->where('value', $this->type)->first()['title'];
    }

    public function isAlphabetAnswer(): Attribute
    {
        return new Attribute(
            get: fn() => in_array($this->type, [
                'summation',
                'calculation',
            ])
                ? true
                : false
        );
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswerRule::class, 'assessment_rule_id', 'id');
    }

    public function indicators(): HasMany
    {
        return $this->hasMany(AssessmentIndicatorRule::class, 'assessment_rule_id', 'id');
    }
}

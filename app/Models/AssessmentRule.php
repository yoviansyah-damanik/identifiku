<?php

namespace App\Models;

use App\Helpers\GeneralHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentRule extends Model
{
    protected $guarded = ['id'];

    public function typeName(): Attribute
    {
        return new Attribute(
            get: fn() => collect(GeneralHelper::getAssessmentRuleType())->where('value', $this->type)->first()['title']
        );
    }
    public function isAlphabetAnswer(): Attribute
    {
        return new Attribute(
            get: fn() => in_array($this->type, [
                'summation',
                'calculation',
                'calculation-2',
            ])
                ? true
                : false
        );
    }

    public function details(): HasMany
    {
        return $this->hasMany(AssessmentRuleDetail::class);
    }
}

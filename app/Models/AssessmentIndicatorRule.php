<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentIndicatorRule extends Model
{
    protected $guarded = ['id'];

    public function main(): BelongsTo
    {
        return $this->belongsTo(AssessmentRule::class, 'assessment_rule_id', 'id');
    }
}

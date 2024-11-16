<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentRuleDetail extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function main(): BelongsTo
    {
        return $this->belongsTo(AssessmentRule::class, 'assessment_rule_id', 'id');
    }
}

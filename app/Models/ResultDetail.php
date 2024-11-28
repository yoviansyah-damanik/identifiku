<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultDetail extends Model
{
    protected $guarded = ['id'];

    public function result(): BelongsTo
    {
        return $this->belongsTo(Result::class);
    }
}

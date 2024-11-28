<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Result extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function details(): HasMany
    {
        return $this->hasMany(ResultDetail::class, 'result_id', 'id');
    }
}

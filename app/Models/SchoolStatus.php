<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolStatus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function schools(): HasMany
    {
        return $this->hasMany(School::class, 'school_status_id', 'id');
    }
}

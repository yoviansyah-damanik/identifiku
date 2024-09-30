<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationLevel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(GradeLevel::class);
    }
}

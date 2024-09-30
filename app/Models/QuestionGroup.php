<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionGroup extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}

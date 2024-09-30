<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}

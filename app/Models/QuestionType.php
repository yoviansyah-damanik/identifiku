<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class QuestionType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function questionsRecap(): Attribute
    {
        return new Attribute(
            get: function () {
                $result = collect($this->questions)
                    ->groupBy('type')
                    ->map(function ($type, $key) {
                        return [
                            'type' => __(Str::headline($key)),
                            'count' => $type->count()
                        ];
                    })
                    ->values();

                return $result;
            }
        );
    }

    public function questionsTotal(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->questions->count();
            }
        );
    }

    public function groups(): HasMany
    {
        return $this->hasMany(QuestionGroup::class);
    }

    public function questions(): HasManyThrough
    {
        return $this->hasManyThrough(Question::class, QuestionGroup::class, 'question_type_id', 'question_group_id', 'id', 'id');
    }
}

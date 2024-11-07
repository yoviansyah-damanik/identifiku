<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Administrator extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function picture(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('type', 'picture');
    }

    public function hasRelation(): MorphOne
    {
        return $this->morphOne(UserHasRelation::class, 'modelable');
    }

    public function mediable(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, UserHasRelation::class, 'modelable_id', 'id', 'id', 'user_id')
            ->where('modelable_type', Administrator::class);
    }
}

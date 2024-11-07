<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserHasRelation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function modelable(): MorphTo
    {
        return $this->morphTo();
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'id', 'modelable_id');
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id', 'modelable_id');
    }

    public function school(): HasOne
    {
        return $this->hasOne(School::class, 'id', 'modelable_id')
            ->without(['province', 'regency', 'district', 'village']);
    }

    public function administrator(): HasOne
    {
        return $this->hasOne(Administrator::class, 'id', 'modelable_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class School extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];
    public $with = ['province', 'regency', 'district', 'village'];

    public function fullAddress(): Attribute
    {
        return new Attribute(
            get: fn() => $this->address .
                ', ' .
                $this->village->name .
                ', ' .
                $this->district->name .
                ', ' .
                $this->regency->name .
                ', ' .
                $this->province->name .
                ', ' .
                $this->postal_code
        );
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(SchoolStatus::class, 'school_status_id', 'id');
    }

    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function picture(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('type', 'picture');
    }

    public function mediables(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'province_id', 'code');
    }

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'regency_id', 'code');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'district_id', 'code');
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'village_id', 'code');
    }

    public function hasRelation(): MorphOne
    {
        return $this->morphOne(UserHasRelation::class, 'modelable');
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, UserHasRelation::class, 'modelable_id', 'id', 'id', 'user_id')
            ->where('modelable_type', School::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolRequest extends Model
{
    protected $guarded = ['id'];

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

    public function status(): BelongsTo
    {
        return $this->belongsTo(SchoolStatus::class, 'school_status_id', 'id');
    }

    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
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
}

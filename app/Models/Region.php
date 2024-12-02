<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name'];

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function schoolCount(): Attribute
    {
        return new Attribute(
            get: fn() => $this->schoolProvince->count() +
                $this->schoolRegency->count() +
                $this->schoolDistrict->count() +
                $this->schoolVillage->count()
        );
    }
    public function scopeProvince($query)
    {
        $query->whereRaw('length(code) = 2');
    }

    public function scopeRegency($query, ?string $province_id = null)
    {
        $query->whereRaw('length(code) = 5');

        if ($province_id)
            $query->where('code', 'like', $province_id . '.%');
    }

    public function scopeDistrict($query, ?string $regency_id = null)
    {
        $query->whereRaw('length(code) = 8');

        if ($regency_id)
            $query->where('code', 'like', $regency_id . '.%');
    }

    public function scopeVillage($query, ?string $district_id = null)
    {
        $query->whereRaw('length(code) = 13');

        if ($district_id)
            $query->where('code', 'like', $district_id . '.%');
    }

    public function schoolProvince(): HasMany
    {
        return $this->hasMany(School::class, 'province_id', 'code');
    }

    public function schoolRegency(): HasMany
    {
        return $this->hasMany(School::class, 'regency_id', 'code');
    }

    public function schoolDistrict(): HasMany
    {
        return $this->hasMany(School::class, 'district_id', 'code');
    }

    public function schoolVillage(): HasMany
    {
        return $this->hasMany(School::class, 'village_id', 'code');
    }
}

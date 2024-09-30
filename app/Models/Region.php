<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeProvince($query)
    {
        $query->whereRaw('length(code) = 2');
    }

    public function scopeRegency($query, $province_id)
    {
        $query->whereRaw('length(code) = 5')
            ->where('code', 'like', $province_id . '.%');
    }

    public function scopeDistrict($query, $regency_id)
    {
        $query->whereRaw('length(code) = 8')
            ->where('code', 'like', $regency_id . '.%');
    }

    public function scopeVillage($query, $district_id)
    {
        $query->whereRaw('length(code) = 13')
            ->where('code', 'like', $district_id . '.%');
    }
}

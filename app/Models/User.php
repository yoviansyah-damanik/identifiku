<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Query\JoinClause;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'is_suspended',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roleName(): Attribute
    {
        return new Attribute(
            get: fn() => $this->roles[0]->name
        );
    }

    public function picture(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('type', 'picture');
    }

    public function student(): HasOneThrough
    {
        return $this->hasOneThrough(Student::class, UserHasRelation::class, 'tes1', 'tes2', 'tes3', 'tes4')
            ->where('model_type', Student::class);
    }

    public function dataRelation(): Attribute
    {
        return new Attribute(
            get: function () {
                switch ($this->roleName) {
                    case 'School':
                        return DB::table('schools', 's')
                            ->join('user_has_relations as ur', function (JoinClause $join) {
                                $join->on('ur.modelable_id', '=', 's.id')
                                    ->where('ur.modelable_type', '=', School::class);
                            })
                            ->where('ur.user_id', $this->id)
                            ->first();
                    case 'Administrator':
                    case 'Superadmin':
                        return DB::table('administrators', 'a')
                            ->join('user_has_relations as ur', function (JoinClause $join) {
                                $join->on('ur.modelable_id', '=', 'a.id')
                                    ->where('ur.modelable_type', '=', Administrator::class);
                            })
                            ->where('ur.user_id', $this->id)
                            ->first();
                    case 'Student':
                        return DB::table('students', 's')
                            ->selectRaw('s.*, sc.name as schoolName')
                            ->join('user_has_relations as ur', function (JoinClause $join) {
                                $join->on('ur.modelable_id', '=', 's.id')
                                    ->where('ur.modelable_type', '=', Student::class);
                            })
                            ->join('schools as sc', 'sc.id', '=', 's.school_id')
                            ->where('ur.user_id', $this->id)
                            ->first();
                }
            }
        );
    }
}

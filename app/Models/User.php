<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\ConfigurationHelper;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasUuids;

    protected $with = ['roles'];
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

    public function isClassLimit(): Attribute
    {
        return new Attribute(
            get: fn() => $this->studentClasses->count() > ConfigurationHelper::get('active_class_limit')
        );
    }

    public function isAdmin(): Attribute
    {
        return new Attribute(
            get: fn() => in_array($this->roleName, ['Administrator', 'Superadmin'])
        );
    }

    public function isTeacher(): Attribute
    {
        return new Attribute(
            get: fn() => $this->roleName === 'Teacher'
        );
    }

    public function isStudent(): Attribute
    {
        return new Attribute(
            get: fn() => $this->roleName === 'Student'
        );
    }

    public function isSchool(): Attribute
    {
        return new Attribute(
            get: fn() => $this->roleName === 'School'
        );
    }

    public function getSchoolData(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->roleName == 'Student') {
                    return $this->student->school;
                }

                if ($this->roleName == 'Teacher') {
                    return $this->teacher->school;
                }

                if ($this->roleName == 'School') {
                    return $this->school;
                }
            }
        );
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

    public function studentClasses(): HasMany
    {
        return $this->hasMany(StudentClass::class, 'teacher_id', 'id');
    }

    public function hasRelation(): HasOne
    {
        return $this->hasOne(UserHasRelation::class, 'user_id', 'id');
    }

    public function teacher(): HasOneThrough
    {
        return $this->hasOneThrough(Teacher::class, UserHasRelation::class, 'user_id', 'id', 'id', 'modelable_id')
            ->where('modelable_type', Teacher::class);
    }

    public function student(): HasOneThrough
    {
        return $this->hasOneThrough(Student::class, UserHasRelation::class, 'user_id', 'id', 'id', 'modelable_id')
            ->where('modelable_type', Student::class);
    }

    public function school(): HasOneThrough
    {
        return $this->hasOneThrough(School::class, UserHasRelation::class, 'user_id', 'id', 'id', 'modelable_id')
            ->without(['province', 'regency', 'district', 'village'])
            ->where('modelable_type', School::class);
    }

    public function administrator(): HasOneThrough
    {
        return $this->hasOneThrough(Administrator::class, UserHasRelation::class, 'user_id', 'id', 'id', 'modelable_id')
            ->where('modelable_type', Administrator::class);
    }

    public function superadmin(): HasOneThrough
    {
        return $this->hasOneThrough(Administrator::class, UserHasRelation::class, 'user_id', 'id', 'id', 'modelable_id')
            ->where('modelable_type', Administrator::class);
    }
}

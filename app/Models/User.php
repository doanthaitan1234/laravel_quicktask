<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'isAdmin',
        'isActive',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'isAdmin',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     * Create global scope
     *
     * @return void
     */
     protected static function booted()
     {
         static::addGlobalScope('ancient', function (Builder $builder) {
             $builder->where('isActive', 1);
         });
     }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
    public function setUserNameAttribute()
    {
        $this->attributes['username'] =  Str::slug($this->username);
    }
    /**
     * Create local scope
     *
     */
    public function scopeAdmin($query)
    {
        return $query->where('isAdmin', 1);
    }
}

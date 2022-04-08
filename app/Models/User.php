<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Defines\Define;

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
        'user_name'
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
    //  protected static function booted()
    //  {
    //      static::addGlobalScope('ancient', function (Builder $builder) {
    //          $builder->where('isActive', 1);
    //      });
    //  }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
    public function setuser_nameAttribute()
    {
        $this->attributes['user_name'] =  Str::slug($this->user_name);
    }
    /**
     * Create local scope
     *
     */
    public function scopeAdmin($query)
    {
        return $query->where('isAdmin', 1);
    }

    public static function rules($rule = 0)
    {
        return [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:200',
            'password' => ($rule != 0 ? 'required|confirmed|min:8|max:20': ''),
        ];
    }
}

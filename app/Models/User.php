<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Expert;
use App\Models\datetime;
use App\Models\TimeResrvation;
use App\Models\Resrvation;
use App\Models\Experiences;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'acc_type',
        'acc_balanced'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function resrvation()
    {
        return $this->hasMany(Resrvation::class);
    } 
    
    public function TimeResrvation()
    {
        return $this->hasMany(TimeResrvation::class);
    }

    public function experience()
    {
        return $this->hasMany(Experiences::class);
    }

    public function expert()
    {
        return $this->hasMany(Expert::class);
    }

    public function datetime()
    {
        return $this->hasMany(datetime::class);
    }


    

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Resrvation;
use App\Models\Experiences;
use App\Models\TimeResrvation;

class Expert extends Model
{
    use HasFactory;

    protected $table='experts';
    protected  $fillable=['name','title','phone','description','user_id'];
   
   public function user()
   {
    return $this->belongsTo(User::class);
   }

    public function experience()
    {
        return $this->hasMany(Experiences::class);
    }

    public function resrvation()
    {
        return $this->hasMany(Resrvation::class);
    } 
    
    public function TimeResrvation()
    {
        return $this->hasMany(TimeResrvation::class);
    }


    public function experiences()
    {
        return $this->belongsToMany(Experiences::class);
    }

}

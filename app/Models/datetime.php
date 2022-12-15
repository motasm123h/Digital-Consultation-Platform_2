<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Resrvation;
use App\Models\Experiences;
use App\Models\TimeResrvation;


class datetime extends Model
{
    use HasFactory;
    protected $table='datetimes';
    protected  $fillable=['date','user_id','day'];
    
    public function user()
    {
        return $this->belongs(User::class);
    }
   
}

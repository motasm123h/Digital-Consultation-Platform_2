<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expert;



class TimeResrvation extends Model
{
    use HasFactory;
    protected $table='time_resrvations';
    
    protected $fillable=['expert_name','day','resv_date','user_id','expert_id'];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
    
}

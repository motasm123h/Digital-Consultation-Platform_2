<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expert;

class TimeResrvation extends Model
{
    use HasFactory;
    protected $table='time_resrvations';
    protected $fillable=['Day','strat_resrvation','end_resrvation','expert_id','user_id'];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
    
}

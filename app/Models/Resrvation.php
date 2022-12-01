<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expert;

class Resrvation extends Model
{
    use HasFactory;
    protected $table='resrvations';

    protected $fillable=['Day','Start_Res','End_Res','expert_id'];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expert;

class Resrvation extends Model
{
    use HasFactory;
    protected $table='resrvations';

    protected $fillable=['day','start_resrv','end_resrv','user_id'];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}

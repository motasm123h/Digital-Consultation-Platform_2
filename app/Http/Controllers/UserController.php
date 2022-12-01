<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Resrvation;
use App\Models\Experiences;

class UserController extends Controller
{

    //4
    public function expertANDexperience()
    {
        $experts=Expert::all();
        if(count($experts)==0)
            {
             return response()->json([
            'message'=>'Empty | Zero Expert',
            ],201);
            }
        return response()->json([
            'message'=>'done success',
            'expert'=>$experts,
        ],200);
    }


    public function showexpert($id)
    {
        $expert=Expert::find($id);
        $time=TimeResrvation::where('expert_id',$expert->user_id)->get();
        if(!$expert)
            {
                return response()->json([
                    'message'=>'Mission canceled'
                ],201);
            }
        else
            {
                return response()->json([
                    'message'=>'Mission Done Success',
                    'expert'=>$expert,
                    'Timereservation' =>$time
                ],200);
            }    
    }
}

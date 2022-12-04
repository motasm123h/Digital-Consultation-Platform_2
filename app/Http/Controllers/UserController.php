<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Experiences;

class UserController extends Controller
{

    //4
    public function show_the_related_experts($consulting)
    {   
        $consultings=Experiences::where('Consulting',$consulting)->get();             
        return response()->json([
            'message'=>'done success',
            'consulting'=>$consultings,
            'expert'=>$consultings->experts(),
        ],200);

    }


    public function Specific_Expert($id)
    {
        $expert=Expert::find($id);
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
                    'Timereservation' =>$expert->TimeResrvation()->get(),
                    'reservation' =>$expert->resrvation()->get()
                ],200);
            } 


    }
}

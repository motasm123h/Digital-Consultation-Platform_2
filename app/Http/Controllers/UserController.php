<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Experiences;
use Illuminate\Support\Carbon;
use App\Http\Controllers\ResrvationController ;

class UserController extends Controller
{

    //4
    public function show_the_related_experts($keys)
    {   
        $cons = Experiences::where('cons_type','=',$keys)->get();
        $experts = [];
        $information = [];
    
        foreach($cons as $key => $con){
            $experts[$key] = User::where([
                ['acc_type','=','E'],
                ['id','=',$con->user_id],
            ])->get();
            
            $information[$key]=Expert::where([
                ['user_id','=', $con->user_id]
            ])->get();
        }

        return response()->json([
            'message'=>'done success',
            'experts'=>$information,
            'count'=> count($cons)         
        ],200);

    }


    public function Specific_Expert($id)
    {
        //notice
        //here the front should send me the user_id not the expert id
        $expert = User::where([
            ['id','=',$id],
            ['acc_type','=','E']
        ])->first();

        $info = Expert::where('user_id','=',$id)->get();
        $info[0]->image = '/images/'.$info[0]->image;
        $dates = ResrvationController::date($id);
        if($expert == null)
        {
            return response()->json([
                'message'=>'Mission canceled'
            ],201);
        }
        
        return response([
            'message'=>'Mission Done Success',
            'expert'=>$expert,
            'information' => $info,
            'Timereservation' =>$expert->TimeResrvation()->get(),
            'reservation' =>$expert->resrvation()->get(),
            'dates'=>$dates,
        ],200);
        
    }
    
}

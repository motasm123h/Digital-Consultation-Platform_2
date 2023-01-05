<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Experiences;
use App\Models\Resrvation;

use App\Models\Rating;
use Illuminate\Support\Carbon;
use App\Http\Controllers\ResrvationController;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    //4
    public function show_the_related_experts($keys)
    {   
        $cons = Experiences::where('cons_type','=',$keys)->get();
        $experts = [];
        $information = [];
        $timeResrvation = [];
        $late_dates = [];
        $early_dates = [];
        $all = [];
        $reating = [];
        
        foreach($cons as $key => $con){

        //here to show the basic information    
        $experts[$key] = User::where([
            ['acc_type','=','E'],
            ['id','=',$con->user_id],
        ])->get();
        
        //here to show the all information
        $information[$key]=Expert::where([
            ['user_id','=', $con->user_id]
        ])->get();

        //here to show the early dates
        $early_dates[$key] = ResrvationController::early_date($con->user_id);
        
        //here to show the lates dates
        $late_dates[$key] = ResrvationController::late_date($con->user_id);

        //$timeResrvation[$key]=$experts[$key]->resrvation()->get();
        $timeResrvation[$key]=Resrvation::where([
            ['user_id','=',$con->user_id],
        ]);

        //here i merege the all user
        $all[$key]=Arr::collapse([$experts[$key],$information[$key],[$early_dates[$key]]]);
        
        }

        return response()->json([
            'message'=>'done success',
            //'experts'=>$information,
            'user'=>$all,         
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

        if($expert == null)
        {
            return response()->json([
                'message'=>'this page is empty | sorry'
            ],201);
        }

        $info = Expert::where('user_id','=',$id)->get();
        $rating=Rating::where('user_id','=',$id)->get();

        $info[0]->image = '/images/'.$info[0]->image;

        
        return response([
            'message'=>'Mission Done Success',
            'expert'=>$expert,
            'Timereservation' =>$expert->TimeResrvation()->get(),
            'reservation' =>$expert->resrvation()->get(),
            'information' => $info,
            'Early dates'=>$early_dates,
            'Late date' =>$late_dates,
        ],200);
        
    }
    
}

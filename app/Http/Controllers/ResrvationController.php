<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\datetime;
use App\Models\TimeResrvation;

use App\Models\User;
use Illuminate\Support\Carbon;

class ResrvationController extends Controller
{
    public static function date($user_id)
    {
        
        $dates=datetime::all()->where('user_id',$user_id);
        return $dates;

    }

    public function make_resrvation(Request $request ,$id)
    {
        $atter=$request->validate([
            'resv_date'=>'required',
            'day'=>'required',
        ]);
        
        $date=Carbon::createFromFormat('Y-m-d H',$atter['resv_date']);
        
        //here the reservation for ever expert
        $timeResrvation=TimeResrvation::create([
        'resv_date'=>$date,
        'day'=>$atter['day'],
        'user_id'=>auth()->user()->id,
        'expert_id'=>$id
        ]);



        //here we update the time reservation for the next week
        $new_date=datetime::where([
            ['user_id','=', $id],
            ['date','=',$date],
            ['day','=',$atter['day']]
        ])->first();

        if(!$new_date)
        {
            return response()->json([
                'message'=>'invaild operation',
            ]);
        }

        $test=$new_date->update([
            'date'=>$date->addWeek()
        ]);
        

        $user=User::where('id',auth()->user()->id)->get()->first();        
        if(!$user)
        {
            return response()->json([
                'message' => 'Invaild Operation',
            ],201);
        }
        $new_user_bala=$user->acc_balanced - 100 ;
        $new_user=$user->update([
             'acc_balanced' => $new_user_bala ,       
        ]);

        $expert=User::where('id',$id)->get()->first();
        if(!$expert)
        {
             return response()->json([
                'message' => 'invalid Operation',
            ],201);
        }

        $new_expert_bala = $expert->acc_balanced + 100 ;
        $new_user=$expert->update([
                'acc_balanced'=> $new_expert_bala ,
            ]);
        
        
          return response()->json([
            'message'=>'done succes',
            'timeresrvation'=>$timeResrvation,
          ]);  
    }
}

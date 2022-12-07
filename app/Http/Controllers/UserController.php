<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Experiences;
use Illuminate\Support\Carbon;

class UserController extends Controller
{

    //4
    public function show_the_related_experts($keys)
    {   
        $cons = Experiences::where('cons_type','=',$keys)->get();
        $experts = [];
        $information = [];
        foreach($cons as $key => $con){
            // dd($key,$cons,$con);
            $experts[$key] = User::where([
                ['acc_type','=','E'],
                ['id','=',$con->user_id],
            ])->get();
            
            $information[$key]=Expert::where([
                ['user_id','=',$con->user_id]
            ])->first()->get();
        }

        return response()->json([
            'message'=>'done success',
            'experts'=>$information,           
        ],200);

    }


    public function Specific_Expert($id)
    {
        //notice
        //here the front should send me the user_id not the expert id
        $expert=User::find($id);
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

    public function make_resrvation($id)
    {
        $expert=User::where('id',$id)->get();

            return response()->json([
                'expert'=>$expert,
                'resrvation'=>$expert->resrvation()->get(),
            ]);

        // $atter=$request->validate([
        //     'day'=>'required',
        //     'resv_date'=>'required',
        // ]);
        // $resrv=TimeResrvation::create([
        //     'day'=>$atter['day'],
        //     'resv'=>Carbon::createFromFormat('H:i:s',$atter['start_resrv'])->format('H:i'),
        // ]);
    }
}

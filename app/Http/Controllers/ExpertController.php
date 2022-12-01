<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Experiences;

class ExpertController extends Controller
{
    
        //this is to add the name and the other things
    public function Experiences(Request $request)
    {
        $atter=$request->validate([
            'title'=>'required|string',
            'phone'=>'required|numeric|digits:9',
            'description'=>'required'
        ]);
        $expert=Expert::create([
            'name'=>auth()->user()->name,
            'title'=>$atter['title'],
            'phone'=>$atter['phone'],
            'description'=>$atter['description'],
            'user_id'=>auth()->user()->id,
        ]);

        return response()->json([
            'message'=>'Expert add success',
            'expert'=>$expert
        ],200);
    }

    //this for the ReservationTime
    public function ReservaationTime(Request $request)
    {
        $atter=$request->validate([
            'Day'=>'required:string',
            'strat_resrvation'=>'required',
            'end_resrvation'=>'required',
        ]);
        $TimeReservation=TimeResrvation::create([
            'Day'=>$atter['Day'],
            'strat_resrvation'=>$atter['strat_resrvation'],
            'end_resrvation'=>$atter['end_resrvation'],
            'expert_id'=>auth()->user()->id,
        ]);

         return response()->json([
            'message'=>'TimeReservation add success',
            'expert'=>$TimeReservation,
        ],200);
    }

    //this is for the Experiences

    public function Experience(Request $request)
    {
        //*//
        $atter=$request->validate([
            'Consulting'=>'required',
        ]);
        $consulting=Experiences::create([
            'Consulting'=>$atter['Consulting'].',',
            'expert_id'=>auth()->user()->id,
        ]);

        return response()->json([
            'message'=>'mission done success',
            'Consulting'=>$consulting, 
        ],200);
    }



    public function ShowExpert()
    {
        //*//
        $experts=Expert::all();
        foreach($experts as $expert)
        {
            $TimeReservation=TimeResrvation::findOrFail($expert->user_id);
        }
        
        return response()->json([
            'message'=>'mission done success',
            'Expert'=>$experts,
            'timeresrvation'=>$TimeReservation, 
        ],200);
    }    


}

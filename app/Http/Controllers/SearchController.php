<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Experiences;


class SearchController extends Controller
{
    public function search($type)
    {
         $experts = [];
        $information = [];

         $cons_array=[
            '1'=>'Business Consulting',
            '2'=>'Medical Consultations',
            '3'=>'Career Consulting',
            '4'=>'Psychological counseling ',
            '5'=>'Family Counseling',
        ];

        $key=array_search($type,$cons_array);
        //search by the Expert name
        
        
        
        //search by the cons_type
        $cons=Experiences::where('cons_type',$key)->get();
        
         //if the user search on a exerts
        if(count($cons)==0)
        {
        return response()->json([
            'message' => 'Result found success',
            'expert' => User::where([
                    ['name','like','%'.$type.'%'],
                    ['acc_type','=','E']
                                   ])->get(),
        ],200);
        }

        $experts=User::where([
            ['name','like','%'.$type.'%'],
            ['acc_type','=','E']
            ])->get();   


        //if there is no result
        if(count($experts) == 0 && count($cons)==0)
        {
            return response()->json([
                'message'=>'Sorry | We did not find anything ',
            ]);
        }

        foreach($cons as $key => $con)
        {
            $experts[$key] = User::where([
                ['acc_type','=','E'],
                ['id','=',$con->user_id],
            ])->get();
            
            $information[$key]=Expert::where([
                ['user_id','=', $con->user_id]
            ])->get();
        }

        //if the user search on a consulting
        return response()->json([
            'message' => 'Result found success',
            'result' => $information,
        ],200);
    }
}

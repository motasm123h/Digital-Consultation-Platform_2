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
        $experts=Expert::where('name','like','%'.$type.'%')->get();
        if(count($experts) == 0)
        {
            return response()->json([
                'message'=>'Sorry | We didnt find anything ',
            ]);
        }
        return response()->json([
            'message' => 'Result found success',
            'result' => $experts,
           //'expert' => $expert->experiences()->get(),

        ],200);
    }
}

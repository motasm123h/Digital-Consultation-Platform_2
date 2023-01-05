<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function make_rating(Request $request , $id )
    {
        $atter = $request->validate([
            'rating' => 'required|integer',
        ]);

        $rating = Rating::create([
            'user_id' => auth()->user()->id,
            'expert_id' =>$id,
            'rating'=>$atter['rating'],
        ]);

        return response()->json([
            'message' => 'success',
            'rating'  => $rating, 
        ],200);
    }
}

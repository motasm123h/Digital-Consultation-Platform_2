<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function FavoriteOrNot($id)
    {
        $user=User::find($id);
        if(!user)
        {
            return response()->json([
                'message'=>'Expert not found',
            ],403);
        }
        $Favorite=Favorite::create([
            'user_id'=>auth()->user->id,
            'expert_id'=>$id,
            'FavOrNot'=>1
        ]);

        return response()->json([
            'message' => 'done succes',
            'Favorite' => $Favorite,
        ]);

    }
}

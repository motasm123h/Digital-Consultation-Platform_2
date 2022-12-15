<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //register
    public function register(Request $request)
    {
        //validat
         $atter = $request->validate(
            [
                'name'=>'required|string',
                'email' => 'required|email|unique:users,email',
                'password'=>'required|min:8',
                'acc_type' =>'string'
            ]);
        $user=User::create([
            'name' => $atter['name'],
            'email' => $atter['email'],
            'password' => Hash::make($atter['password']),
            'acc_type' => $atter['acc_type'],
        ]);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ],200);

    }

    //login
    public function login(Request $request)
    {
        $atter = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($atter))
        {
            return response([
                'message' => 'Inavild Crdenatail'
            ],403);            
        }
        return response([
            'user' => auth()->user(),
            'token' =>auth()->user()->createToken('secret')->plainTextToken
        ]);
    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'logout success'
        ],200);
    }

    public function user()
    {
        return response([
            'user'=>auth()->user(),
        ],200);
    }
    
    public function update(Request $request)
    {
        $atter=$request->validate([
            'name' =>'required|string',
        ]);
        auth()->user()->update([
            'name'=>$atter['name'],
        ]);
        return response([
            'message'=>'updated successfully',
            'user'=>auth()->user(),
        ],200);
    }

    public function reg(Reuest $req)
    {
        dd('here');
    }
}

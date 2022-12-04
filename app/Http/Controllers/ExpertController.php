<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Expert;
use App\Models\TimeResrvation;
use App\Models\Experiences;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ExpertController extends Controller
{
    
    //this is to add the name and the other things
    public function Experiences(Request $request)
    {
        $atter=$request->validate([
            'title'=>'required|string',
            'phone'=>'required|numeric|digits:9',
            'description'=>'required',
            //'image'=>'required|image|mimes:jpeg,png,gif,svg|max:2048'
        ]);

      //  $imagename=Str::random(32).".".$request->image->getClientOriginalExtension();
        $expert=Expert::create([
            'name'=>auth()->user()->name,
            'title'=>$atter['title'],
            'phone'=>$atter['phone'],
            'description'=>$atter['description'],
        //    'image'=>$imagename,
            'user_id'=>auth()->user()->id,
        ]);

        // Storage::disk('public')->put($imagename,file_get_contents($request->image));
        return response()->json([
            'message'=>'Expert add success',
            'expert'=>$expert
        ],200);
    }


    //this for the ReservationTime
    public function ReservationTime(Request $request)
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
            'Consulting'=>$atter['Consulting'],
            'expert_id'=>auth()->user()->id,
        ]);

        return response()->json([
            'message'=>'mission done success',
            'Consulting'=>$consulting, 
        ],200);
    }

    public function EditTesrvationTime(Request $request,$id)
    {
        $atter=$request->validate([
            'Day'=>'required',
            'strat_resrvation'=>'required',
            'end_resrvation'=>'required',
        ]);
        $resrvation=TimeResrvation::findOrFail($id);
        
        $newRes=$resrvation->update([
            'Day'=>$atter['Day'],
            'start_resrvation'=>$atter['strat_resrvation'],
            'end_resrvation'=>$atter['end_resrvation'], 
        ]);

        return response()->json([
            'message'=>'success',
            'resrvation after edit ' => $newRes
        ]);

    }


    public function EditExperience(Request $request,$id)
    {
        $atter=$request->validate([
            'Consulting'=>'required',
        ]);
        $experience=Experience::findOrFail($id);
        $newCons=$experience->update([
            'Consulting'=>$atter['Consulting'],
        ]);

        return response()->json([
            'message'=>'success',
            'resrvation after edit ' => $newCons
        ]);

    }

    public function DeleteTesrvationTime($id)
    {
        $resrvation=TimeResrvation::findOrFail($id);
        return response()->json([
            'message' => 'deleted success',
            'result' => $resrvation->delete()
        ]);
    }

     public function DeleteTExperience($id)
    {
        $consulting=Experience::findOrFail($id);
        return response()->json([
            'message' => 'deleted success',
            'result' => $consulting->delete()
        ]);
    }
    


    public function HomeExpert()
    {
        $experts=Expert::find(auth()->user()->id);
        return response()->json([
            'message'=>'mission done success',
            'Expert'=>$experts,
            'timeresrvation'=>$experts->TimeResrvation()->get(),
            'rsrvation'=>$experts->resrvation()->get(),
            'expert'=>$experts->experiences()->get() 
        ],200);
    } 

}

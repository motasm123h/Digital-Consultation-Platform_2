<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Expert;
use App\Models\datetime;
use App\Models\TimeResrvation;
use App\Models\Resrvation;
use App\Models\Experiences;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class ExpertController extends Controller
{
    
    //this is to add the name and the other things
    public function Experiences(Request $request)
    {
        $atter=$request->validate([
            'title'=>'required|string',
            'phone'=>'required|numeric|digits:10',
            'description'=>'required',
            'image'=>'required|image|mimes:jpg,png|max:2048'
        ]);

        $imgName = time().'-'.auth()->user()->name.'.'.$request->image->extension();
        $ImagePath = $request->image->move(public_path('images'),$imgName);
        
        $expert=Expert::create([
            'name'=>auth()->user()->name,
            'title'=>$atter['title'],
            'phone'=>$atter['phone'],
            'description'=>$atter['description'],
            'image'=>$imgName,
            'user_id'=>auth()->user()->id,
        ]);

        return response()->json([
            'message'=>'Expert add success',
            'expert'=>$expert
        ],200);
    }


    //this for the ReservationTime
    public function TimeSchedule(Request $request)
    {
        $atter=$request->validate([
            'day'=>'required:string',
            'start_resrv'=>'required',
            'end_resrv'=>'required',
        ]);
        $start = Carbon::createFromFormat('Y-m-d H',$atter['start_resrv']);
        $end = Carbon::createFromFormat('Y-m-d H',$atter['end_resrv']);
        
        //here i create the TimeSchedule
        $TimeReservation=Resrvation::create([
            'day'=>$atter['day'],
            'start_resrv'=>$start,
            'end_resrv'=>$end,
            'user_id'=>auth()->user()->id,
        ]);

        //here i well splet the time in to hours
         while($start->toTimeString() != $end->toTimeString() )
         {
            datetime::create([
               'day' => $atter['day'],
               'date' => $start,
               'user_id' => auth()->user()->id,
            ]);
            $start->addHour();
         }
            
         return response()->json([
            'message'=>'TimeReservation add success',
            'expert'=>$TimeReservation,
        ],200);
    }

    //this is for the Experiences

        
    public function Experience(Request $request)
    {
        //*//
        $cons_array=[
            '1'=>'Business Consulting',
            '2'=>'Medical Consultations',
            '3'=>'Career Consulting',
            '4'=>'Psychological counseling',
            '5'=>'Family Counseling',
        ];

        //validate the consulting
        $atter=$request->validate([
            'cons_type'=>'required',
        ]);

        $input=$request->all();
        $cons=$input['cons_type'];
        foreach($cons as $con)
        {
        $key=array_search($con,$cons_array);
        $consulting=Experiences::create([
            'cons_type'=>$key,
            'user_id'=>auth()->user()->id,
        ]);
        }

        return response()->json([
            'message'=>'mission done success',
            'Consulting'=>$consulting,
            'cons'=>count($cons) 
        ],200);
    }


    //this is to edit resrvation at the doctor
    public function EditTesrvationTime(Request $request,$id)
    {
        $atter=$request->validate([
            'day'=>'required',
            'start_resrv'=>'required|date',
            'end_resrv'=>'required|date',
        ]);
        $resrvation=Resrvation::find($id);
        if(!$resrvation)
        {
            return response()->json([
                'message'=>'Sorry | there is no result'
            ],201);
        }
        $newRes=$resrvation->update([
            'day'=>$atter['day'],
            'start_resrv'=>$atter['start_resrv'],
            'end_resrv'=>$atter['end_resrv'], 
        ]);

        return response()->json([
            'message'=>'success',
            'resrvation after edit ' => $newRes
        ]);

    }


    // this is to edit consulting
    public function EditExperience(Request $request,$id)
    {
        $cons_array=[
            '1'=>'Business Consulting',
            '2'=>'Medical Consultations',
            '3'=>'Career Consulting',
            '4'=>'Psychological counseling ',
            '5'=>'Family Counseling',
        ];

        $atter=$request->validate([
            'cons_type'=>'required',
        ]);

        
        $experience=Experience::find($id);

        if(!$experience)
        {
            return response()->json([
                'message'=>'Sorry | there is no result'
            ],201);
        }

        $newCons=$experience->update([
            'cons_type'=>$atter['cons_type'],
        ]);
        

        $key=array_search($atter['cons_type'],$cons_array);
        return response()->json([
            'message'=>'success',
            'resrvation after edit ' => $newCons
        ]);
    }


    //this is to delete resrvation
    public function DeleteTesrvationTime($id)
    {
        $resrvation=Resrvation::find($id);

       if(!$resrvation)
        {
            return response()->json([
                'message'=>'Sorry | there is no result'
            ],201);
        }
        
       if($resrvation->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'permission denied.',
            ],403);
        }


        return response()->json([
            'message' => 'deleted success',
            'result' => $resrvation->delete()
        ]);
    }


    //this is to delete a consulting
    public function DeleteTExperience($id)
    {
        $consulting=Experiences::find($id);

       if(!$consulting)
        {
            return response()->json([
                'message'=>'Sorry | there is no result'
            ],201);
        }
        
       if($consulting->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'permission denied.',
            ],403);
        }


        return response()->json([
            'message' => 'deleted success',
            'result' => $consulting->delete()
        ]);
    }
    


    public function HomeExpert()
    {
        $experts=User::find(auth()->user()->id);
        return response()->json([
            'message'=>'mission done success',
            'public information'=>$experts,
            'timeresrvation'=>$experts->TimeResrvation()->get(),
            'rsrvation'=>$experts->resrvation()->get(),
            'expert'=>$experts->expert()->get(),
            'experience'=>$experts->experience()->get(), 
        ],200);
    } 

}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Carbon;
use App\Http\Controllers\ResrvationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware(['auth:sanctum'])->group(function () {

Route::get('user', [AuthController::class,'user']);
Route::put('update', [AuthController::class,'update']);
Route::post('logout', [AuthController::class,'logout']);
//this is for search
Route::get('search/{type}', [SearchController::class,'search']);

        //this block for expert Permissions
        Route::middleware(['CheckUser'])->group(function(){
        Route::post('AddInfo',[ExpertController::class,'Experiences']);
        Route::post('ReservationTime',[ExpertController::class,'TimeSchedule']);
        Route::post('Experience',[ExpertController::class,'Experience']);
        Route::get('HomeExpert',[ExpertController::class,'HomeExpert']);
        //edit resrvation
        Route::put('ReservationTime/edit/{id}',[ExpertController::class,'EditTesrvationTime']);
        //edit experience
        Route::put('Experience/edit/{id}',[ExpertController::class,'EditExperience']);
        //delete resrvation
        Route::delete('ReservationTime/delete/{id}',[ExpertController::class,'DeleteTesrvationTime']);
        //delete experience
        Route::delete('Experience/delete/{id}',[ExpertController::class,'DeleteTExperience']);        
        });

        //this block is for user Permissions
        Route::middleware(['CheckExpert'])->group(function(){
        Route::get('UserView/{keys}',[UserController::class,'show_the_related_experts']);
        Route::get('show/{id}', [UserController::class,'Specific_Expert']);
        Route::post('show/{id}/make_dates', [ResrvationController::class,'make_resrvation']);
        });
});



// Route::middleware('auth:sanctum')->get('user', [AuthController::class,'user']);
// Route::middleware('auth:sanctum')->put('update', [AuthController::class,'update']);
// Route::middleware('auth:sanctum')->post('logout', [AuthController::class,'logout']);

//this is commone for all


// //this is for Expert to add information
// Route::middleware('auth:sanctum','CheckUser')->post('AddInfo',[ExpertController::class,'Experiences']);
// Route::middleware('auth:sanctum','CheckUser')->post('ReservationTime',[ExpertController::class,'TimeSchedule']);
// Route::middleware('auth:sanctum','CheckUser')->post('Experience',[ExpertController::class,'Experience']);
// //this route is for expert home
// Route::middleware('auth:sanctum','CheckUser')->get('HomeExpert',[ExpertController::class,'HomeExpert']);
// //edit resrvation
// Route::middleware('auth:sanctum','CheckUser')->put('ReservationTime/edit/{id}',[ExpertController::class,'EditTesrvationTime']);
// //edit experience
// Route::middleware('auth:sanctum','CheckUser')->put('Experience/edit/{id}',[ExpertController::class,'EditExperience']);
// //delete resrvation
// Route::middleware('auth:sanctum','CheckUser')->delete('ReservationTime/delete/{id}',[ExpertController::class,'DeleteTesrvationTime']);
// //delete experience
// Route::middleware('auth:sanctum','CheckUser')->delete('Experience/delete/{id}',[ExpertController::class,'DeleteTExperience']);




// Route::middleware('auth:sanctum','CheckExpert')->get('UserView/{keys}',[UserController::class,'show_the_related_experts']);
// Route::middleware('auth:sanctum','CheckExpert')->get('show/{id}', [UserController::class,'Specific_Expert']);

// Route::middleware('auth:sanctum','CheckExpert')->post('show/{id}/make_dates', [ResrvationController::class,'make_resrvation']);

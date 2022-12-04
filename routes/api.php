<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

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

Route::middleware('auth:sanctum')->get('user', [AuthController::class,'user']);
Route::middleware('auth:sanctum')->put('update', [AuthController::class,'update']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class,'logout']);

//this is commone for all
Route::middleware('auth:sanctum')->get('search/{type}', [SearchController::class,'search']);


//this is for Expert to add information
Route::middleware('auth:sanctum','CheckUser')->post('AddInfo',[ExpertController::class,'Experiences']);
Route::middleware('auth:sanctum','CheckUser')->post('ReservationTime',[ExpertController::class,'ReservationTime']);
Route::middleware('auth:sanctum','CheckUser')->post('Experience',[ExpertController::class,'Experience']);
//this route is for expert home
Route::middleware('auth:sanctum','CheckUser')->get('HomeExpert',[ExpertController::class,'HomeExpert']);
//edit resrvation
Route::middleware('auth:sanctum','CheckUser')->put('ReservationTime/edit/{id}',[ExpertController::class,'EditTesrvationTime']);
//edit experience
Route::middleware('auth:sanctum','CheckUser')->put('Experience/edit/{id}',[ExpertController::class,'EditExperience']);
//delete resrvation
Route::middleware('auth:sanctum','CheckUser')->delete('ReservationTime/delete/{id}',[ExpertController::class,'DeleteTesrvationTime']);
//delete experience
Route::middleware('auth:sanctum','CheckUser')->delete('Experience/delete/{id}',[ExpertController::class,'DeleteTExperience']);




Route::middleware('auth:sanctum')->get('UserView/{consulting}',[UserController::class,'show_the_related_experts']);
Route::middleware('auth:sanctum','CheckExpert')->get('show/{id}', [UserController::class,'Specific_Expert']);

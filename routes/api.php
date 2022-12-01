<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

//this is for Expert
Route::middleware('auth:sanctum','CheckUser')->post('AddInfo', [ExpertController::class,'Experiences']);
Route::middleware('auth:sanctum','CheckUser')->post('ReservaationTime', [ExpertController::class,'ReservaationTime']);
Route::middleware('auth:sanctum','CheckUser')->get('ShowExpert', [ExpertController::class,'ShowExpert']);
Route::middleware('auth:sanctum','CheckUser')->post('Experience', [ExpertController::class,'Experience']);
Route::middleware('auth:sanctum','CheckExpert')->get('UserView', [UserController::class,'expertANDexperience']);
Route::middleware('auth:sanctum','CheckExpert')->get('show/{id}', [UserController::class,'showexpert']);

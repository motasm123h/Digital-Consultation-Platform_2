<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ResrvationController;
use App\Http\Controllers\RatingController;



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
        Route::post('show/{id}/make_dates', [ResrvationController::class,'make_resrvation']);
        Route::post('show/{id}/make_rating',[RatingController::class,'make_rating']);
        
        Route::get('UserView/{keys}',[UserController::class,'show_the_related_experts']);
        Route::get('show/{id}', [UserController::class,'Specific_Expert']);
        });
});
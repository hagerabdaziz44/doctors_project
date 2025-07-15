<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EditProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Doctors'], function () {

  
    Route::post('login', [AuthController::class, 'login']);


});


Route::group(['middleware' => 'checkUser'], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'getProfile']);

    
     Route::post('edit/profile', [EditProfileController::class, 'editProfile']);
    // Route::post('triage-doctor/change-password', [AuthController::class, 'changePassword']);
});
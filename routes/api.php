<?php

use App\Http\Controllers\Api\TriageDoctor\AuthController;
use App\Http\Controllers\Api\TriageDoctor\EditProfileController;
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

Route::group(['namespace' => 'TriageDoctors'], function () {

    Route::post('triage-doctor/register', [AuthController::class, 'register']);
    Route::post('triage-doctor/login', [AuthController::class, 'login']);

    // Add more public routes if needed
});


Route::group(['middleware' => 'checkUser:triage-doctor-api'], function () {

    Route::post('triage-doctor/logout', [AuthController::class, 'logout']);
    Route::get('triage-doctor/profile', [AuthController::class, 'getProfile']);

    
     Route::post('triage-doctor/edit', [EditProfileController::class, 'editProfile']);
    // Route::post('triage-doctor/change-password', [AuthController::class, 'changePassword']);
});
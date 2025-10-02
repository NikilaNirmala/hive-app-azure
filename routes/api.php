<?php

use App\Http\Controllers\Api\AdvertisementController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\RequestController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;





/////////////////////////////////////////////////////////////////////////////////////////////////////
// AUTH ROUTES
/////////////////////////////////////////////////////////////////////////////////////////////////////

Route::middleware('throttle')->group(function () {


    ///////////////////////////////////// LOGIN ROUTES //////////////////////////////////////////////


    Route::post('/login', [AuthController::class, 'login']);



    ////////////////////////////////////SIGN UP ROUTES ////////////////////////////////////////////

    Route::post('/signup/member', [AuthController::class, 'signupMember']);
    Route::post('/signup/agent', [AuthController::class, 'signupAgent']);



    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});







/////////////////////////////////////////////////////////////////////////////////////////////
// ADMIN ROUTES (specific)
//////////////////////////////////////////////////////////////////////////////////////////////


Route::middleware(['auth:sanctum', 'user.check:admin'])->prefix('admin')->group(function () {
Route::get('/show/users', [UserController::class, 'index']);
Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy']);
Route::patch('/advertisements/{advertisement}/valuvate', [AdvertisementController::class, 'valuvate']);
Route::patch('/change-status/{user}', [UserController::class, 'changeStatus']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
});






/////////////////////////////////////////////////////////////////////////////////////////////
// MEMBER ROUTES (specific)
//////////////////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth:sanctum', 'user.check:member'])->prefix('member')->group(function () {
Route::get('/advertisements', [UserController::class, 'getUserAds']);
Route::post('/advertisements', [AdvertisementController::class, 'store']);
Route::patch('/advertisements/{advertisement}', [AdvertisementController::class, 'update']);
Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy']);
Route::post('/requests/create', [RequestController::class, 'store']);
Route::get('/requests', [RequestController::class, 'showSpecific']);
Route::post('/advertisements/{advertisement}/buy', [AdvertisementController::class, 'buyAdvertisement']);
Route::get('/profile', [UserController::class, 'show']);
Route::patch('/reviews/{review}', [ReviewController::class, 'update']);
});








/////////////////////////////////////////////////////////////////////////////////////////////
// AGENT ROUTES (specific)
//////////////////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth:sanctum', 'user.check:agent'])->prefix('agent')->group(function () {
Route::get('/requests', [RequestController::class, 'index']);
Route::get('/requests/{request}', [RequestController::class, 'show']);
Route::delete('/requests/{request}', [RequestController::class, 'destroy']);
Route::patch('/reviews/{review}', [ReviewController::class, 'update']);

});






////////////////////////////////////////////////////////////////////////////////////////
// GUEST ROUTES (All users)
///////////////////////////////////////////////////////////////////////////////////////

Route::prefix('guest')->group( function () {
Route::get('/advertisements', [AdvertisementController::class, 'index']); // guest
Route::get('/reviews', [ReviewController::class, 'index']); // guest
Route::middleware(['throttle:60,1'])->post('/reviews/create', [ReviewController::class, 'store']); // guest
});



















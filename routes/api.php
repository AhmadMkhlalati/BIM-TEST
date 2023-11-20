<?php

use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\TransactionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserLoginController::class,'register']);
Route::post('login',[UserLoginController::class,'login']);

Route::apiResource('transaction',TransactionController::class)->middleware('auth:sanctum');

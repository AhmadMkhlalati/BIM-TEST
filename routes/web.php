<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\FinancialController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('login',[AdminLoginController::class,'create'])->name('login');
Route::post('logout',[AdminLoginController::class,'destory']);
Route::post('login',[AdminLoginController::class,'store']);
Route::get('transaction/fetch',[TransactionController::class,'fetchData'])->middleware('auth');

Route::resource('transaction',TransactionController::class)->middleware('auth');
Route::get('payment/fetch',[PaymentController::class,'fetchData'])->middleware('auth');
Route::resource('payment',PaymentController::class)->middleware('auth');
Route::get('users_search',[UserController::class,'search'])->middleware('auth');
Route::get('generateMonthlyReport',[FinancialController::class,'generateMonthlyReport'])->middleware('auth');
Route::get('reports',[FinancialController::class,'reports'])->middleware('auth');


<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

Route::get('users', [UserController::class,'index'])->middleware('auth:sanctum');
Route::get('/users/{id}', [UserController::class,'show'])->middleware('auth:sanctum');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');

//GENERATE TOKEN
Route::post('/sanctum/token', [AuthController::class,'tokenCreator']);

Route::post("register", [AuthController::class, 'register']);


//ADDRESS

// Route::get('/Addresses/create', [AddressController::class, 'create'])->name('addresses.create');
Route::post('/addresses', [AddressController::class, 'store'])->name('Addresses.store')->middleware('auth:sanctum');
Route::put('/addresses/{id}', [AddressController::class, 'update'])->middleware('auth:sanctum');
Route::get('addresses', [AddressController::class,'index'])->middleware('auth:sanctum');
Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('users.destroy')->middleware('auth:sanctum');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth:sanctum');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update')->middleware('auth:sanctum');
Route::get('orders', [OrderController::class,'index'])->name('orders.index')->middleware('auth:sanctum');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('auth:sanctum');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth:sanctum');


Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

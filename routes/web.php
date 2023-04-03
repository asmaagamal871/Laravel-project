<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

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

Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//USER
Route::get('/users', [UserController::class,'index'])->name('users.index');
// Route::get('/users/create', [UserController::class,'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get("/users/removeOld", [UserController::class,'removeOldPosts']);
// Route::get('/users/{id}', [UserController::class,'show'])->name('users.show');
// Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('/users/{post}', [UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.destroy');


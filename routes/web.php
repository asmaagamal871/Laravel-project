<?php

use App\Models\User;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SendMailController;


use App\Notifications\MailNotification;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PharmacyController;

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

// Route::get('/', function  () {
// User::find(1)->notifiy(new MailNotification);
// //$users=User::find(1);
//    // Notification::send($users,new MailNotification());
//     return view("welcome");

// });



//////////////////////////////////////////////////////medicines//////////////////////////////////////////
Route::get('/medicines',[MedicineController::class,'index'])->name(('medicines.index'));

Route::get('/medicines/create', [MedicineController::class, 'createMedicine'])->name('medicines.create');
 Route::post('/medicines/store', [MedicineController::class, 'storeMedicine'])->name('medicines.store');
 Route::get('/medicines/{medicine}/edit',[MedicineController::class,'editMedicine'])->name('medicines.edit');
 Route::put('/medicines/{medicine}', [MedicineController::class, 'updateMedicine'])->name('medicines.update');
 Route::delete('/medicines/{medicine}',[MedicineController::class,'destoryMedicine'])->name('medicines.destory');
Route::get('/medicines/{medicine}', [MedicineController::class,'showMedicine'])->name('medicines.show');

////////////////////////////////////////////////////stripe/////////////////////////////////////////////
  
 
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});


///////////////////////////////////////////////adresses////////////////////////////////////////////////////////
Route::get('/addresses',[AddressController::class,'index'])->name(('addresses.index'));

Route::get('/addresses/create', [AddressController::class, 'createAddress'])->name('addresses.create');
 Route::post('/addresses/store', [AddressController::class, 'storeAddress'])->name('addresses.store');
 Route::get('/addresses/{address}/edit',[AddressController::class,'editAddress'])->name('addresses.edit');
 Route::put('/addresses/{address}', [AddressController::class, 'updateAddress'])->name('addresses.update');
 Route::delete('/addresses/{address}',[AddressController::class,'destoryAddress'])->name('addresses.destory');
Route::get('/addresses/{address}', [AddressController::class,'showAddress'])->name('addresses.show');
//////////////////////////////////////////email////////////////////////////////

Route::get('/send_emails', [SendMailController::class, 'form'])->name('send_emails_form');
Route::post('/send_emails', [SendMailController::class, 'send_emails'])->name('send_emails');


Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // Route::group(['middleware' => ['permission:manage-own-orders']], function () {
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//USER
// Route::get('/users', [UserController::class,'index'])->name('users.index');
// Route::get('/users/create', [UserController::class,'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get("/users/removeOld", [UserController::class,'removeOldPosts']);
// Route::get('/users/{id}', [UserController::class,'show'])->name('users.show');
// Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('/users/{post}', [UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.destroy');

//PHARMACY
//Route::middleware(['auth'])->group(function (){

Route::resource('pharmacy', PharmacyController::class);
Route::get('/pharmacy/create', [PharmacyController::class,'create'])->name('pharmacy.create');
Route::get('/pharmacy/{pharmacy}', [PharmacyController::class,'show'])->name('pharmacy.show');
Route::get('/', [PharmacyController::class,'index'])->name('pharmacy.index');
Route::post('/pharmacy', [PharmacyController::class, 'store'])->name('pharmacy.store');
Route::get('/pharmacy/{id}/edit', [PharmacyController::class, 'edit'])->name('pharmacy.edit');
Route::put('/pharmacy/{post}', [PharmacyController::class, 'update'])->name('pharmacy.update');
Route::delete('/pharmacy/{id}', [PharmacyController::class, 'destroy'])->name('pharmacy.destroy');
Route::put('pharmacy/{id}/restore', [PharmacyController::class, 'restore'])->name('pharmacy.restore');

Route::put('/pharmacy/{pharmacy}/doctors/{doctor}/ban', [PharmacyController::class, 'banDoctor'])->name('pharmacy.doctors.ban')->middleware('can:ban,doctor');
Route::put('/pharmacy/{pharmacy}/doctors/{doctor}/unban', [PharmacyController::class, 'unbanDoctor'])->name('pharmacy.doctors.unban')->middleware('can:unban,doctor');

//});

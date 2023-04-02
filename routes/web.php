<?php
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SendMailController;
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

// Route::get('/medicines', function  () {
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




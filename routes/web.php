<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\SubscribeController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('customer.home');
})->middleware(['auth', 'isCustomer'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'isAdmin'])->name('dashboard');

Route::middleware(['auth', 'isCustomer'])->group(function () {
    Route::get('/customer-dashboard', [customerController::class, 'home'])->name('home');
    Route::get('/trainor', [customerController::class, 'trainor'])->name('trainor');
    Route::get('/subscribe', [SubscribeController::class, 'index'])->name('subscribe');
    Route::post('/subscribe', [SubscribeController::class, 'redirectPayment'])->name('subscribe');
    Route::get('/payment', [PaymentController::class, 'show'])->name('payment');
    Route::post('/save-payment', [PaymentController::class, 'store'])->name('savePayment');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

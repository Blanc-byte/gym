<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\SubscribeController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\adminController;
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

Route::get('/dashboard', function () {
    $user = Auth::user(); // Get the authenticated user

    if ($user->role === 'admin') {
        return redirect()->route('dashboard'); 
    } elseif ($user->role === 'customer') {
        return redirect()->route('home'); 
    }
    
    abort(403, 'Unauthorized action.');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [adminController::class, 'getAllUnsubscribe'] )->name('dashboard');
    Route::post('/assign-trainers', [adminController::class, 'assignTrainers']);
    Route::get('/viewClients', [adminController::class, 'viewClients'] )->name('viewClients');

    Route::delete('/clients/{id}', [adminController::class, 'destroy'])->name('clients.destroy');
    Route::delete('/clientsUns/{id}', [adminController::class, 'unsubscribe'])->name('clients.unsubscribe');


    Route::get('/trainers', [adminController::class, 'trainers'])->name('trainers');
    Route::post('/trainers', [adminController::class, 'store'])->name('trainers.store');
    Route::get('/trainers/{id}/edit', [adminController::class, 'edit'])->name('trainers.edit');
    Route::put('/trainers/{id}', [adminController::class, 'update'])->name('trainers.update');
    Route::delete('/trainers/{id}', [adminController::class, 'destroyTrainer'])->name('trainers.destroy');
});

Route::get('/', function () {
    return view('welcome');
});


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

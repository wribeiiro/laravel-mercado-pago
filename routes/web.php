<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'payment'])->name('payment');
Route::post('/createPayment', [App\Http\Controllers\PaymentController::class, 'createPayment'])->name('payment.create');

Route::get('/callbackMessage', [App\Http\Controllers\OrderController::class, 'callback'])->name('callback');
Route::get('/notification', [App\Http\Controllers\NotificationController::class, 'notification'])->name('notification');
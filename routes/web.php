<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanDetailsController;
use App\Http\Controllers\EmiDetailsController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// loan details route
Route::get('/loan-details', [LoanDetailsController::class, 'index'])->name('loan.details');

// emi details route
Route::get('/emi-details', [EmiDetailsController::class, 'index'])->name('emi.details');
Route::post('/emi-details/process', [EmiDetailsController::class, 'process'])->name('emi.details.process');
Route::get('/emi-details/show', [EmiDetailsController::class, 'show'])->name('emi.details.show');

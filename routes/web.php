<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'redirect']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/add_doctor', [AdminController::class, 'addView']);
Route::post('/store_doctor', [AdminController::class, 'storeDoctor']);
Route::post('/appointment', [AdminController::class, 'storeAppointment']);
Route::get('/myappointments', [HomeController::class, 'myappointments']);
Route::get('/cancel_appointment/{id}', [HomeController::class, 'cancelAppointment']);
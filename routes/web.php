<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogoutController;
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

Route::get('/', [Controller::class, 'index'])->name('home');

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');

Route::get('/select/{id}', [DashboardController::class, 'selectDashboard'])->middleware('auth')->name('dashboard.select');

Route::post('/', [DashboardController::class, 'store'])->middleware('auth')->name('dashboard.store');

Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

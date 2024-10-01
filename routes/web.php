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

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/select/{id}', [DashboardController::class, 'selectDashboard'])->name('dashboard.select');

Route::post('/dashboard.store', [DashboardController::class, 'store'])->name('dashboard.store');

Route::put('/dashboard.edit', [DashboardController::class, 'update'])->name('dashboard.edit');

Route::delete('/dashboard/{dashboard}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

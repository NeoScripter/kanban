<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TaskController;
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

Route::delete('/dashboard', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/task.store', [TaskController::class, 'store'])->name('task.store');

Route::get('/task/display/{task}', [DashboardController::class, 'index'])->name('task.display');

Route::put('/task/update/{task}', [TaskController::class, 'update'])->name('task.update');

Route::get('/task/display/{task}/editing', [DashboardController::class, 'index'])->name('task.show');

Route::put('/task/edit/{task}', [TaskController::class, 'edit'])->name('task.edit');

Route::delete('/task/delete/{task}', [TaskController::class, 'destroy'])->name('task.destroy');

Route::get('lang/{locale}', function ($locale) {
    if (!array_key_exists($locale, config('app.locales'))) {
        abort(400);
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('lang.switch');

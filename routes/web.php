<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect('login');
});

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'loginPost'])->name('login.post');

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('providers', [DashboardController::class, 'providers'])->name('dashboard.providers');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

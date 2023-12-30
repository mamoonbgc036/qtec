<?php

use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\User\RegisterController;


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

Route::get('/user/login', [LoginController::class, 'index'])->name('user.login');
Route::post('/user/login', [LoginController::class, 'store']);

Route::get('/user/register', [RegisterController::class, 'index'])->name('user.register');
Route::post('/user/register', [RegisterController::class, 'store']);


Route::get('/{short_url}', [DashboardController::class, 'redirect']);

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('user.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/shorten', [DashboardController::class, 'shorten'])->name('dashboard.shorten');
    Route::post('/dashboard/shorten', [DashboardController::class, 'short_url']);
    Route::get('dashboard/{url}', [DashboardController::class, 'edit'])->name('url.edit');
    Route::put('/dashboard/{url}', [DashboardController::class, 'update'])->name('url.update');
    Route::delete('/dashboard/{url}', [DashboardController::class, 'destroy'])->name('url.destroy');
});

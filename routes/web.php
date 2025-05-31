<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


//Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login-post');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}/{email}', [AuthController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //Employee
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/{employee}/status', [EmployeeController::class, 'status'])->name('employees.status');
});

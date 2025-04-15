<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Employee\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Đăng nhập
    Route::get('login', [AccountController::class, 'login'])->name('login');
    Route::post('login', [AccountController::class, 'postLogin'])->name('postLogin');

    Route::middleware(AdminAuthenticated::class)->group(function () {
        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Quản lý phòng ban
        Route::resource('departments', DepartmentController::class);
        // Quản lý nhân viên
        Route::resource('employee', EmployeeController::class);
        // Đăng xuất
        Route::post('logout', [AccountController::class, 'logout'])->name('logout');
    });
});

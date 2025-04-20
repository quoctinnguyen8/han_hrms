<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AfterUniversityController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DisciplineController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ForeignLanguageController;
use App\Http\Controllers\Admin\ScientificResearchTopicController;
use App\Http\Controllers\Admin\ScientificWorkController;

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
        // Trình độ ngoại ngữ
        Route::resource('foreign_languages', ForeignLanguageController::class);
        // Nghiên cứu khoa học
        Route::resource('scientific_research_topics', ScientificResearchTopicController::class);
        // Công trình khoa học
        Route::resource('scientific_works', ScientificWorkController::class);
        //Đào tạo sau đại học
        Route::resource('after_universities', AfterUniversityController::class);
        // Khen thưởng
        Route::resource('bonuses', BonusController::class);
        //Kỷ luật
        Route::resource('disciplines', DisciplineController::class);
        //Thông tin hơp đồng
        Route::resource('contracts', ContractController::class);
        // Đăng xuất
        Route::post('logout', [AccountController::class, 'logout'])->name('logout');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Middleware\EmployeeAuthenticated;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AfterUniversityController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DisciplineController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ForeignLanguageController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ScientificResearchTopicController;
use App\Http\Controllers\Admin\ScientificWorkController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Employee\AccountController as EmployeeAccountController;
use App\Http\Controllers\Employee\ProfileController;

// Trang chủ chung (nếu cần)
Route::get('/', function () {
    return view('welcome');
});

// =========================
// 👨‍💼 ADMIN ROUTES
// =========================
Route::prefix('admin')->name('admin.')->group(function () {
    // Đăng nhập
    Route::get('login', [AdminAccountController::class, 'login'])->name('login');
    Route::post('login', [AdminAccountController::class, 'postLogin'])->name('postLogin');
    Route::resource('management', ManagementController::class);

    // Các route cần đăng nhập admin
    Route::middleware(AdminAuthenticated::class)->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        // Xuất dữ liệu nhân viên ra file Excel
        Route::get('export-excel', [AdminDashboardController::class, 'exportExcel'])->name('exportExcel');
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
        // Đào tạo sau đại học
        Route::resource('after_universities', AfterUniversityController::class);
        // Khen thưởng
        Route::resource('bonuses', BonusController::class);
        // Kỷ luật
        Route::resource('disciplines', DisciplineController::class);
        // Thông tin hợp đồng
        Route::resource('contracts', ContractController::class);
        // Đăng xuất
        Route::get('logout', [AdminAccountController::class, 'logout'])->name('logout');

        // Thay đổi mật khẩu
        Route::get('change-password', [AdminAccountController::class, 'changePasswordView'])->name('changePasswordView');
        Route::post('change-password', [AdminAccountController::class, 'changePassword'])->name('changePassword');

        // Thống kê
        Route::get('employees-by-department', [ReportController::class, 'employeesByDepartment'])->name('employees-by-department');
        Route::get('employees-by-education-level', [ReportController::class, 'employeesByEducationLevel'])->name('employees-by-education-level');
        Route::get('employees-by-specialization', [ReportController::class, 'employeesBySpecialization'])->name('employees-by-specialization');
        Route::get('employee-seniority', [ReportController::class, 'employeeSeniority'])->name('employee-seniority');
        Route::get('bonus-discipline-by-year', [ReportController::class, 'bonusDisciplineByYear'])->name('bonus-discipline-by-year');
        Route::get('research-by-year', [ReportController::class, 'researchByYear'])->name('research-by-year');
        Route::get('employee-by-contract', [ReportController::class, 'employeeContract'])->name('employee-contract');
    });
});

// =========================
// 👷 EMPLOYEE ROUTES
// =========================
Route::prefix('employee')->name('employee.')->middleware(EmployeeAuthenticated::class)->group(function () {

    Route::get('login', [EmployeeAccountController::class, 'login'])->name('login');
    Route::post('login', [EmployeeAccountController::class, 'postLogin'])->name('postLogin');

    // Hồ sơ cá nhân
    Route::get('/detail', [ProfileController::class, 'detail'])->name('profile.detail');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Đăng xuất
    Route::get('logout', [EmployeeAccountController::class, 'logout'])->name('logout');
});

<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;

// Global route (for base domain)
Route::get('/', function () {
    return view('welcome'); // Landing page or tenant selection page
});

// Tenant-specific routes (for subdomains)
Route::middleware(['auth', 'identifyTenant'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Employee routes (protected by 'can:manageEmployees')
    Route::middleware('can:manageEmployees')->group(function () {
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/update/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/delete/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

    // Report routes (protected by 'can:generateReports')
    Route::middleware('can:generateReports')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/generate', [ReportController::class, 'generateReport'])->name('reports.generate');
    });

    // Admin-only routes
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    // Manager-only routes
    Route::middleware('can:isManager')->group(function () {
        Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    });

    // Employee-only routes
    Route::middleware('can:isEmployee')->group(function () {
        Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    });
});

require __DIR__.'/auth.php';
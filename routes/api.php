<?php
// Path: routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Auth\LoginController;

// Employee API Routes (protected by 'auth:sanctum' and 'can:manageEmployees')
Route::middleware(['auth:sanctum', 'can:manageEmployees'])->group(function () {
    Route::apiResource('employees', EmployeeController::class);

    // Optional: Custom routes for additional functionality
    Route::get('employees/search/{keyword}', [EmployeeController::class, 'search']); // Search employees by keyword
    Route::get('employees/department/{department}', [EmployeeController::class, 'getByDepartment']); // Get employees by department
});

// Example of a protected route (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});

Route::post('login', [LoginController::class, 'login']);
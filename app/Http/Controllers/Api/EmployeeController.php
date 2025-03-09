<?php
// app/Http/Controllers/Api/EmployeeController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can view employees

        try {
            // Get filter criteria from the request
            $search = $request->query('search');
            $department = $request->query('department');
            $position = $request->query('position');
            $minSalary = $request->query('min_salary');
            $maxSalary = $request->query('max_salary');
            $perPage = $request->query('per_page', 10); // Configurable pagination

            // Query employees with filters
            $employees = Employee::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('position', 'like', "%{$search}%");
            })
            ->when($department, function ($query, $department) {
                return $query->where('department', $department);
            })
            ->when($position, function ($query, $position) {
                return $query->where('position', $position);
            })
            ->when($minSalary, function ($query, $minSalary) {
                return $query->where('salary', '>=', $minSalary);
            })
            ->when($maxSalary, function ($query, $maxSalary) {
                return $query->where('salary', '<=', $maxSalary);
            })
            ->paginate($perPage);

            return response()->json($employees);
        } catch (\Exception $e) {
            Log::error('Error fetching employees: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching employees.'], 500);
        }
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can create employees

        try {
            $employee = Employee::create($request->validated());
            return response()->json($employee, 201);
        } catch (\Exception $e) {
            Log::error('Error creating employee: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the employee.'], 500);
        }
    }

    public function show(Employee $employee)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can view employee details
        return response()->json($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can update employees

        try {
            $employee->update($request->validated());
            return response()->json($employee);
        } catch (\Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the employee.'], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can delete employees

        try {
            $employee->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the employee.'], 500);
        }
    }
}
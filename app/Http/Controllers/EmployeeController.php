<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can view employees

        $tenant = $request->tenant;

        try {
            // Get filter criteria from the request
            $search = $request->query('search');
            $department = $request->query('department');
            $position = $request->query('position');
            $minSalary = $request->query('min_salary');
            $maxSalary = $request->query('max_salary');
            $perPage = $request->query('per_page', 5); // Configurable pagination

            // Initialize the query builder
            $query = $tenant ? $tenant->employees() : Employee::query();

            // Apply filters to the query
            $query->when($search, function ($query, $search) {
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
            });

            // Paginate the results
            $employees = $query->paginate($perPage);

            // Get unique departments and positions for filter dropdowns
            $departments = $tenant ? $tenant->employees()->distinct()->pluck('department') : Employee::distinct()->pluck('department');
            $positions = $tenant ? $tenant->employees()->distinct()->pluck('position') : Employee::distinct()->pluck('position');

            // Return JSON response for AJAX requests (Load More)
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('employees.partials.employee_rows', compact('employees'))->render(),
                    'next_page_url' => $employees->nextPageUrl(),
                ]);
            }

            return view('employees.index', compact('employees', 'departments', 'positions'));
        } catch (Exception $e) {
            Log::error('Error fetching employees: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'An error occurred while fetching employees.');
        }
    }

    public function create(Request $request)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can create employees

        $tenant = $request->tenant;

        // Get unique departments and positions for dropdowns
        $departments = $tenant ? $tenant->employees()->distinct()->pluck('department') : Employee::distinct()->pluck('department');
        $positions = $tenant ? $tenant->employees()->distinct()->pluck('position') : Employee::distinct()->pluck('position');

        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can create employees

        $tenant = $request->tenant;

        try {
            $employee = new Employee($request->validated());
            $tenant ? $tenant->employees()->save($employee) : $employee->save();

            return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating employee: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'An error occurred while creating the employee.');
        }
    }


    public function edit(Request $request, Employee $employee)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can edit employees

        $tenant = $request->tenant;

        // Get unique departments and positions for dropdowns
        $departments = $tenant ? $tenant->employees()->distinct()->pluck('department') : Employee::distinct()->pluck('department');
        $positions = $tenant ? $tenant->employees()->distinct()->pluck('position') : Employee::distinct()->pluck('position');

        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }


    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can update employees

        $tenant = $request->tenant;

        try {
            $employee->update($request->validated());

            return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating employee: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'An error occurred while updating the employee.');
        }
    }

    public function destroy(Request $request, Employee $employee)
    {
        $this->authorize('manageEmployees'); // Only Admin and Manager can delete employees

        $tenant = $request->tenant;

        try {
            $employee->delete();

            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting employee: ' . $e->getMessage());
            return redirect()->route('employees.index')->with('error', 'An error occurred while deleting the employee.');
        }
    }
    

}

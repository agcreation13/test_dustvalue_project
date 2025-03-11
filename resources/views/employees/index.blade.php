@extends('layouts.app')

@section('content')

<div class="container-fluid mx-auto px-4 py-6">
    <div class="mx-auto bg-white shadow-md rounded-lg p-6">
        <!-- Top Row: Breadcrumb and Right Side Buttons -->
        <div class="top-row ">
            <!-- Breadcrumb -->
            <div class="text-info">
                <a class="text-red-600 hover:text-blue-500" href="/dashboard">Dashboard</a> / Employees List
            </div>

            <!-- Right Side Buttons -->
            <div class="right-side-buttons">
                <!-- Export Form -->
                <div class="export-form">
                    <form action="{{ route('reports.generate') }}" method="GET" class="flex items-center gap-2">
                        <label> Export Format :-> </label>
                        <select name="format" id="format" class="input-field">
                            <option value="pdf">PDF</option>
                            <option value="csv">CSV</option>
                        </select>
                        <button type="submit" class="btn btn-primary">
                            Export Report
                        </button>
                    </form>
                </div>

                <!-- Add Employee Button -->
                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                    + Add Employee
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
        <!-- Success Alert Modal -->
        <div id="success-alert" class="fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg flex justify-between items-center w-96">
            <span>{{ session('success') }}</span>
            <button id="close-alert" class="text-green-700 hover:text-green-900">
                &times; <!-- Close icon -->
            </button>
        </div>
        @endif

        <!-- Search and Filter Form -->
        <div class="search-filters">
            <form action="{{ route('employees.index') }}" method="GET" class="flex items-center gap-2 flex-wrap">
                <!-- Search Input -->
                <input
                    type="text"
                    name="search"
                    placeholder="Search by name, email, or position"
                    value="{{ request('search') }}"
                    class="input-field"
                />

                <!-- Department Filter -->
                <select
                    name="department"
                    class="input-field"
                >
                    <option value="">All Departments</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>

                <!-- Position Filter -->
                <select
                    name="position"
                    class="input-field"
                >
                    <option value="">All Positions</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                            {{ $position }}
                        </option>
                    @endforeach
                </select>

                <!-- Salary Range Filters -->
                <input
                    type="number"
                    name="min_salary"
                    placeholder="Min Salary"
                    value="{{ request('min_salary') }}"
                    class="input-field"
                />
                <input
                    type="number"
                    name="max_salary"
                    placeholder="Max Salary"
                    value="{{ request('max_salary') }}"
                    class="input-field"
                />

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    Search
                </button>

                <!-- Clear Filters Button -->
                @if (request('search') || request('department') || request('position') || request('min_salary') || request('max_salary'))
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                        Clear Filters
                    </a>
                @endif
            </form>
        </div>

        <!-- Employees Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $key => $employee)
                        <tr>
                            <!-- Serial Number -->
                            <td>{{ ($employees->currentPage() - 1) * $employees->perPage() + $key + 1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn delete-button" onclick="return confirm('Are you sure you want to delete this employee?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="pagination">
            {{ $employees->appends([
                'search' => request('search'),
                'department' => request('department'),
                'position' => request('position'),
                'min_salary' => request('min_salary'),
                'max_salary' => request('max_salary'),
            ])->links('employees.pagination') }} <!-- Use a custom pagination view -->
        </div>
    </div>
</div>
@endsection
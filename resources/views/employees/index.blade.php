@extends('layouts.app')

@section('content')
<style>
    select {
        background-position: right 0.75rem center !important;
        background-size: 12px 12px !important;
    }
</style>

<div class="container-fluid mx-auto px-4 py-6">
    <div class="mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800"><a class="text-red-600 hover:text-blue-500" href="/dashboard">Dashboard</a> / Employees List</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search, Filter, and Export Form -->
        <div class="mb-4 flex justify-between items-center flex-wrap gap-4">
            <!-- Add Employee Button -->
            <a href="{{ route('employees.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Employee
            </a>

            <!-- Export Form -->
            <form action="{{ route('reports.generate') }}" method="GET" class="flex items-center space-x-4">
                <label for="format" class="text-gray-700">Export Format:</label>
                <select name="format" id="format" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="pdf">PDF</option>
                    <option value="csv">CSV</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                    Export Report
                </button>
            </form>

            <!-- Search and Filter Form -->
            <form action="{{ route('employees.index') }}" method="GET" class="flex items-center space-x-4">
                <!-- Search by Name, Email, or Position -->
                <input
                    type="text"
                    name="search"
                    placeholder="Search by name, email, or position"
                    value="{{ request('search') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />

                <!-- Filter by Department -->
                <select
                    name="department"
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">All Departments</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>

                <!-- Filter by Position -->
                <select
                    name="position"
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">All Positions</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                            {{ $position }}
                        </option>
                    @endforeach
                </select>

                <!-- Filter by Salary Range -->
                <input
                    type="number"
                    name="min_salary"
                    placeholder="Min Salary"
                    value="{{ request('min_salary') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <input
                    type="number"
                    name="max_salary"
                    placeholder="Max Salary"
                    value="{{ request('max_salary') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700"
                >
                    Search
                </button>

                <!-- Clear Filters Button -->
                @if (request('search') || request('department') || request('position') || request('min_salary') || request('max_salary'))
                    <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Clear Filters
                    </a>
                @endif
            </form>
        </div>

        <!-- Employees Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 border">Sr</th>
                        <th class="py-3 px-4 border">Name</th>
                        <th class="py-3 px-4 border">Email</th>
                        <th class="py-3 px-4 border">Position</th>
                        <th class="py-3 px-4 border">Department</th>
                        <th class="py-3 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $key => $employee)
                        <tr class="border-b hover:bg-gray-100">
                            <!-- Calculate Serial Number -->
                            <td class="py-3 px-4 border">
                                {{ ($employees->currentPage() - 1) * $employees->perPage() + $key + 1 }}
                            </td>
                            <td class="py-3 px-4 border">{{ $employee->name }}</td>
                            <td class="py-3 px-4 border">{{ $employee->email }}</td>
                            <td class="py-3 px-4 border">{{ $employee->position }}</td>
                            <td class="py-3 px-4 border">{{ $employee->department }}</td>
                            <td class="py-3 px-4 border">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                    <span class="text-gray-400">|</span>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $employees->appends([
                'search' => request('search'),
                'department' => request('department'),
                'position' => request('position'),
                'min_salary' => request('min_salary'),
                'max_salary' => request('max_salary'),
            ])->links() }}
        </div>
    </div>
</div>
@endsection
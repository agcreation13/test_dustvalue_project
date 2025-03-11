@extends('layouts.app')

@section('content')
    <div class="mt-6">
        <!-- Role-Based Dashboard Sections -->
        @can('isAdmin')
            @include('admin.dashboard') <!-- Include Admin Dashboard -->
        @endcan

        @can('isManager')
            @include('manager.dashboard') <!-- Include Manager Dashboard -->
        @endcan

        @can('isEmployee')
            @include('employees.dashboard') <!-- Include Employee Dashboard -->
        @endcan
    </div>

    <!-- Chart Section (Visible to Admin and Manager) -->
    @can('isAdmin', 'isManager')
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Employees by Department Chart -->
            <div>
                <h2 class="text-xl font-bold mb-4">Employees by Department</h2>
                <div id="departmentChart"></div> <!-- Chart Container -->
            </div>

            <!-- Employees by Position Chart -->
            <div>
                <h2 class="text-xl font-bold mb-4">Employees by Position</h2>
                <div id="positionChart"></div> <!-- Chart Container -->
            </div>
        </div>
    @endcan
   <!-- Pass Data to JavaScript -->
   <script>
    window.departmentSeries = @json($chartData['departments']['series']);
    window.departmentCategories = @json($chartData['departments']['categories']);
    window.positionSeries = @json($chartData['positions']['series']);
    window.positionCategories = @json($chartData['positions']['categories']);
</script>
@endsection
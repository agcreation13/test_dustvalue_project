@extends('layouts.app')

@section('content')
    <div class="mt-6">
        @can('isAdmin')
            @include('admin.dashboard')
        @endcan

        @can('isManager')
            @include('manager.dashboard')
        @endcan

        @can('isEmployee')
            @include('employees.dashboard')
        @endcan
    </div>

    @can('isAdmin' , 'isManager')
    <!-- Chart Section -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Employees by Department Chart -->
        <div>
            <h2 class="text-xl font-bold mb-4">Employees by Department</h2>
            <div id="departmentChart"></div>
        </div>

        <!-- Employees by Position Chart -->
        <div>
            <h2 class="text-xl font-bold mb-4">Employees by Position</h2>
            <div id="positionChart"></div>
        </div>
    </div>
    @endcan
</div>

<!-- ApexCharts Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data for the Department Chart
        const departmentChartData = {
            chart: {
                type: 'bar',
                height: 350,
            },
            series: [{
                name: 'Employees',
                data: @json($chartData['departments']['series']) // Dynamic series data
            }],
            xaxis: {
                categories: @json($chartData['departments']['categories']) // Dynamic categories
            }
        };

        // Render the Department Chart
        const departmentChart = new ApexCharts(document.querySelector("#departmentChart"), departmentChartData);
        departmentChart.render();

        // Data for the Position Chart
        const positionChartData = {
            chart: {
                type: 'bar',
                height: 350,
            },
            series: [{
                name: 'Employees',
                data: @json($chartData['positions']['series']) // Dynamic series data
            }],
            xaxis: {
                categories: @json($chartData['positions']['categories']) // Dynamic categories
            }
        };

        // Render the Position Chart
        const positionChart = new ApexCharts(document.querySelector("#positionChart"), positionChartData);
        positionChart.render();
    });
</script>
@endsection
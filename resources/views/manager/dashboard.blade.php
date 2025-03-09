{{--  Manager Dashboard --}}
<div class="mt-4 p-4 bg-blue-100 rounded-lg">
    <div class="flex justify-between items-center">
        <!-- Left Side: Text Information -->
        <div>
            <h2 class="text-xl font-bold">Manager Dashboard {{ $tenant }}</h2>
            <p>Welcome, Manager! You can manage employees and view reports.</p>
        </div>
        
        <!-- Right Side: Button -->
        <a href="{{ route('employees.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Manage Employees
        </a>
    </div>
</div>

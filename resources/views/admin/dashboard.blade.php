{{-- Admin Dashboard --}}
<div class="admin-dashboard">
    <div class="dashboard-content">
        <!-- Left Side: Text Information -->
        <div class="text-info">
            <h2>Admin Dashboard {{ $tenant }}</h2>
            <p>Welcome, Admin! You have full access to the system.</p>
        </div>
        
        <!-- Right Side: Button -->
        <a href="{{ route('employees.index') }}" class="btn btn-primary">
            Manage Employees
        </a>
    </div>
</div>
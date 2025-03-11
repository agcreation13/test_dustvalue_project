{{-- Manager Dashboard --}}
<div class="admin-dashboard">
    <div class="dashboard-content">
        <!-- Left Side: Text Information -->
        <div class="text-info">
            <h2>Manager Dashboard {{ $tenant }}</h2>
            <p>Welcome, Manager! You have full access to the system.</p>
        </div>
        
        <!-- Right Side: Button -->
        <a href="{{ route('employees.index') }}" class="manage-button">
            Manage Employees
        </a>
    </div>
</div>
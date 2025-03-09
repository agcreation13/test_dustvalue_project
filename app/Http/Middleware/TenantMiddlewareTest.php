<?php

// tests/Feature/TenantMiddlewareTest.php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenantMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_tenant_middleware_identifies_tenant()
    {
        DB::enableQueryLog();

        $tenant = Tenant::create(['name' => 'Tenant 1', 'domain' => 'tenant1']);
        $employee = Employee::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'position' => 'Software Engineer',
            'salary'=> 50000,
            'department'=> 'Engineering',
            'joining_date'=> now(),
            'tenant_id' => $tenant->id,
        ]);
    
        $response = $this->get('http://tenant1.example.com/employees');
        $response->assertStatus(200);
    
        // Dump the queries
        dd(\DB::getQueryLog());
    }

    public function test_tenant_middleware_handles_invalid_subdomain()
    {
        $response = $this->get('http://invalid.example.com/employees');
        $response->assertStatus(404);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::create([
            'name' => 'Tenant-1',
            'domain'=> 'tenant1',
            'database_name'=> 'tenant_db1',
        ]);
        Tenant::create([
            'name' => 'Tenant-2',
            'domain'=> 'tenant2',
            'database_name'=> 'tenant_db2',
        ]);
    }
}

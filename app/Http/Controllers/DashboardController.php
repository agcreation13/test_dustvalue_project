<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Import the Employee model

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the number of employees per department
        $departments = Employee::select('department')
            ->groupBy('department')
            ->selectRaw('count(*) as total')
            ->pluck('total', 'department');

        // Fetch the number of employees per position
        $positions = Employee::select('position')
            ->groupBy('position')
            ->selectRaw('count(*) as total')
            ->pluck('total', 'position');

        // Prepare data for the charts
        $chartData = [
            'departments' => [
                'categories' => $departments->keys()->toArray(),
                'series' => $departments->values()->toArray(),
            ],
            'positions' => [
                'categories' => $positions->keys()->toArray(),
                'series' => $positions->values()->toArray(),
            ],
        ];

        $tenant_id = $request->tenant; // Get the current tenant
        if ($tenant_id) {
            // Tenant-specific dashboard
            $tenant = $tenant_id->name;
        } else {
            // Global dashboard (for base domain)
            $tenant ='';
        }

        // return view('dashboard', compact('tenant'));

        return view('dashboard', compact('chartData', 'tenant'));
    }
}
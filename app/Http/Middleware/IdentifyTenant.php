<?php
// app/Http/Middleware/IdentifyTenant.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;
use Illuminate\Support\Facades\Log;

class IdentifyTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost(); // e.g., tenant1.localhost or 127.0.0.1
        $parts = explode('.', $host);

        Log::info('Host: ' . $host);
        Log::info('Parts: ' . json_encode($parts));

        // Skip tenant identification for base domain (e.g., 127.0.0.1 or localhost)
        if ($host === '127.0.0.1' || $host === 'localhost') {
            Log::info('Base domain detected. Skipping tenant identification.');
            return $next($request);
        }

        // Check if the host has subdomains (e.g., tenant1.localhost)
        if (count($parts) > 1 && $parts[0] !== 'www') {
            $subdomain = $parts[0]; // Extract tenant1

            Log::info('Subdomain: ' . $subdomain);

            // Find the tenant by subdomain
            $tenant = Tenant::where('domain', $subdomain)->first();

            if (!$tenant) {
                Log::error('Tenant not found for subdomain: ' . $subdomain);
                return response()->view('errors.404', ['message' => $subdomain . ' not found'], 404);
            }

            // Store the tenant in the request for later use
            $request->merge(['tenant' => $tenant]);
        }

        return $next($request);
    }
}
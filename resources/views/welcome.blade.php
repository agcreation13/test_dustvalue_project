@extends('layouts.app')

@section('page_title', 'Welcome to the Multi-Tenant Application')

@section('content')
  

    <div class="welcome-container">
        <h2>Welcome to the Multi-Tenant Application</h2>
        <p>This is a multi-tenant application that allows you to manage employees.</p>

        <!-- Authenticated User: Show Dashboard Button -->
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
        @endauth

        <!-- Guest User: Show Login and Register Buttons -->
        @guest
            <p>Please login or register to continue.</p>
            <div class="button-group">
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn btn-register">Register</a>
            </div>
        @endguest
    </div>

    <!-- Tenant Links -->
    <div class="tenant-links">
        <h2>Tenants</h2>
        <div class="tenant-buttons">
            <a href="http://tenant1.localhost:8000/" class="btn btn-tenant">Tenant 1</a>
            <a href="http://tenant2.localhost:8000/" class="btn btn-tenant">Tenant 2</a>
        </div>
    </div>
@endsection
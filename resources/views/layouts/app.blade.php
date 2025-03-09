<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Multi-Tenant CRUD Application')</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://laravel.com/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://laravel.com/img/favicon/favicon-16x16.png">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
<nav class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/dashboard" class="text-xl font-bold">Multi-Tenant Application</a>
        <div>
            @auth
                <span class="mr-4">Welcome, {{ auth()->user()->name }}</span>
                <a href="{{ route('logout') }}" class="bg-red-500 px-4 py-2 rounded">Logout</a>
            @else
                <a href="{{ route('login') }}" class="bg-green-500 px-4 py-2 rounded">Login</a>
            @endauth
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

    <footer class="bg-blue-600 p-4 text-white text-center">
        <div class="container mx-auto">
            &copy; 2025 Multi-Tenant Application All rights reserved.
        </div>
    </footer>
<!-- Add this to the <head> section of your layout file -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
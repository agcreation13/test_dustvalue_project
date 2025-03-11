<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Multi-Tenant CRUD Application')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://laravel.com/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://laravel.com/img/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/employees.css') }}">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1><a href="/">Multi-Tenant Application</a></h1>
            <nav class="nav" style="float: end">
                @auth
                    <span class="welcome-message">Welcome, {{ auth()->user()->name }}</span>
                    <a href="{{ route('logout') }}" class="logout-button">Logout</a>
                @else
                    {{-- <a href="{{ route('login') }}" class="login-button">Login</a> --}}
                @endauth
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            &copy; 2025 Multi-Tenant Application. All rights reserved.
        </div>
    </footer>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>
</html>
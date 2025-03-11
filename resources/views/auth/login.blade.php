@extends('layouts.app')

@section('page_title', 'Login Page')

@section('content')
    <div class="form-container">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="form-button">Login</button>
            
        </form>
              <div class="login-link">
                  Don't have an account? <a href="{{ route('register') }}">Register</a>
                </div>

    </div>
@endsection
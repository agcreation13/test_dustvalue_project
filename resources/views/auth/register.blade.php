@extends('layouts.app')

@section('page_title', 'Register Page')

@section('content')
    <div class="form-container">
        <h2>Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="form-button">Register</button>
        </form>

        <!-- Login Link -->
        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login here</a>.
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('page_title', 'Employee Register Page')

@section('content')
    <div class="form-container">
        <h3>
            <a href="/employees">Employee</a> / Create
        </h3>
    
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" id="position" required>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" name="department" id="department" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" name="salary" id="salary" required>
        </div>
        <div class="form-group">
            <label for="joining_date">Joining Date</label>
            <input type="date" name="joining_date" id="joining_date" required>
        </div>
        <div class="form-group">
            <button type="submit" class="form-button">Create</button>
        </div>
    </form>
    <div class="login-link">
        <a href="{{ route('employees.index') }}">Back</a>
    </div>
@endsection

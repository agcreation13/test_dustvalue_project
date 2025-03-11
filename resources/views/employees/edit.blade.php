@extends('layouts.app')

@section('page_title', 'Employee Edit Page')

@section('content')
    <div class="form-container">
        <h3>
            <a href="/employees">Employee</a> / Edit
        </h3>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $employee->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $employee->email }}" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" value="{{ $employee->position }}" required>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" name="department" id="department" value="{{ $employee->department }}" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" name="salary" id="salary" value="{{ $employee->salary }}" required>
            </div>
            <div class="form-group">
                <label for="joining_date">Joining Date</label>
                <input type="date" name="joining_date" id="joining_date" value="{{ $employee->joining_date }}" required>
            </div>
            <div class="form-group">
                <button type="submit" class="form-button">Update</button>
            </div>
        </form>

        <div class="login-link">
            <a href="{{ route('employees.index') }}">Back</a>
        </div>
    </div>
@endsection

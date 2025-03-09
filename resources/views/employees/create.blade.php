@extends('layouts.app')

@section('content')
<div class="max-w-xl m-auto  bg-white p-6 rounded-lg shadow-md">
    <div class="border-b-2 border-gray-200 mb-6">
    <h1 class="text-2xl font-bold mb-4">
        <a class="text-red-600 hover:text-blue-500" href="/employees">Employee
        </a> / Create</h1>
    </div>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="position" class="block text-gray-700">Position</label>
            <input type="text" name="position" id="position" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="department" class="block text-gray-700">Department</label>
            <input type="text" name="department" id="department" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="salary" class="block text-gray-700">Salary</label>
            <input type="number" name="salary" id="salary" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="joining_date" class="block text-gray-700">Joining Date</label>
            <input type="date" name="joining_date" id="joining_date" class="w-full p-2 border rounded" required>
        </div>
        <div class="flex">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
            <a href="{{ route('employees.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-4 hover:bg-gray-400">Back</a>
        </div>
    </form>
</div>
@endsection
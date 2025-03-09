@extends('layouts.app')
@section('page_title', '403 - Forbidden')
@section('content')
<div class="h-screen flex items-center justify-center">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 text-center">
        <h1 class="text-4xl font-bold text-red-600 mb-4">403 - Forbidden</h1>
        <p class="text-gray-700 mb-4">You are not authorized to access this page.</p>
        <a href="{{ url('/dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Go to Home</a>
    </div>
</div>
@endsection
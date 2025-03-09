@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Reports</h1>

    <form action="{{ route('reports.generate') }}" method="GET">
        <div class="mb-4">
            <label for="format" class="block text-gray-700">Export Format</label>
            <select name="format" id="format" class="w-full p-2 border rounded">
                <option value="pdf">PDF</option>
                <option value="csv">CSV</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Generate Report</button>
    </form>
</div>
@endsection
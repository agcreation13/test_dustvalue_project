<!DOCTYPE html>
<html>
<head>
    <title>Employee Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Employee Report</h1>
    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Total Employees</th>
                <th>Average Salary</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $row)
                <tr>
                    <td>{{ $row['department'] }}</td>
                    <td>{{ $row['total_employees'] }}</td>
                    <td>${{ $row['average_salary'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
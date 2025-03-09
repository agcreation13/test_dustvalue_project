<?php
// Path: app/Http/Controllers/ReportController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    // Display the reporting dashboard
    public function index()
    {
        $this->authorize('generateReports'); // Only Admin can access
        return view('reports.index');
    }

    // Generate summary report
    public function generateReport(Request $request)
    {
        $this->authorize('generateReports'); // Only Admin can generate reports

        try {
            // Get report data
            $reportData = $this->getReportData($request->input('tenant_id'));
            // Export format (PDF or CSV)
            $format = $request->input('format', 'pdf');

            if ($format === 'csv') {
                return $this->exportCsv($reportData);
            }
            return $this->exportPdf($reportData);
        } catch (Exception $e) {
            Log::error('Error generating report: ' . $e->getMessage());
            return redirect()->route('reports.index')->with('error', 'An error occurred while generating the report.');
        }
    }

    // Get report data (total employees and average salary per department)
    protected function getReportData($tenantId = null)
    {
        try {
            // Fetch report data in a single query
            $query = Employee::selectRaw('department, COUNT(*) as total_employees, AVG(salary) as average_salary')
                ->groupBy('department');

            if ($tenantId) {
                $query->where('tenant_id', $tenantId);
            }

            $reportData = $query->get()
                ->map(function ($item) {
                    return [
                        'department' => $item->department,
                        'total_employees' => $item->total_employees,
                        'average_salary' => number_format($item->average_salary, 2),
                    ];
                });

            return $reportData;
        } catch (Exception $e) {
            Log::error('Error fetching report data: ' . $e->getMessage());
            throw $e; // Re-throw the exception to handle it in the calling method
        }
    }

    // Export report as CSV
    protected function exportCsv($reportData)
    {
        try {
            $fileName = 'employee_report_' . Carbon::now()->format('Ymd_His') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ];

            $callback = function () use ($reportData) {
                $file = fopen('php://output', 'w');

                // Add CSV headers
                fputcsv($file, ['Department', 'Total Employees', 'Average Salary']);

                // Add data rows
                foreach ($reportData as $row) {
                    fputcsv($file, $row);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (Exception $e) {
            Log::error('Error exporting CSV: ' . $e->getMessage());
            throw $e; // Re-throw the exception to handle it in the calling method
        }
    }

    // Export report as PDF
    protected function exportPdf($reportData)
    {
        try {
            $fileName = 'employee_report_' . Carbon::now()->format('Ymd_His') . '.pdf';

            $pdf = PDF::loadView('reports.pdf', compact('reportData'));
            return $pdf->download($fileName);
        } catch (Exception $e) {
            Log::error('Error exporting PDF: ' . $e->getMessage());
            throw $e; // Re-throw the exception to handle it in the calling method
        }
    }
}
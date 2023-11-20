<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Admin\FinancialReportService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinancialController extends Controller
{
    protected $financialReportService;

    public function __construct(FinancialReportService $financialReportService)
    {
        $this->financialReportService = $financialReportService;
    }
    public function reports(){
        return Inertia::render('Reports');
    }
    public function generateMonthlyReport(Request $request)
    {
        $startDate = $request->input('started_date');
        $endDate = $request->input('ended_date');

        $report = $this->financialReportService->generateMonthlyReport($startDate, $endDate);

        return response()->json($report);
    }
}

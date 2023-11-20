<?php
namespace App\Repositories\Admin;

use App\Interfaces\Admin\FinancialReportRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EloquentFinancialReportRepository implements FinancialReportRepositoryInterface
{
    public function generateMonthlyReport($startDate, $endDate)
    {


        // Run the query
        $result = DB::table('transactions as t1')
            ->selectRaw('MONTH(due_on) as month, YEAR(due_on) as year')
            ->selectRaw('SUM(CASE WHEN status = "paid" THEN amount ELSE 0 END) as paid')
            ->selectRaw('SUM(CASE WHEN status = "outstanding" THEN amount ELSE 0 END) as outstanding')
            ->selectRaw('SUM(CASE WHEN status = "overdue" THEN amount ELSE 0 END) as overdue')
            ->whereBetween('due_on', [$startDate, $endDate])
            ->groupBy(DB::raw('MONTH(due_on), YEAR(due_on)'))
            ->get();

// Format the result as needed
        $report = $result->map(function ($item) {
            return [
                'month' => $item->month,
                'year' => $item->year,
                'paid' => $item->paid,
                'outstanding' => $item->outstanding,
                'overdue' => $item->overdue,
            ];
        });

        return $report->toArray() ;

    }
}
